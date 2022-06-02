<?php

namespace App\ViewModels;

use App\Models\Attention;
use App\Models\Payment;
use App\Services\CurrencyService;
use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class AttentionShowViewModel extends ViewModel
{
    public $currency;
    public function __construct(public Attention $attention)
    {
        $this->currency = new CurrencyService();
        $attention->load('patient')
                    ->load('procedures')
                    ->load('payments')
                    ->load('user');
    }

    public function data()
    {
        return collect($this->attention)->merge([
            'formatted_price' => $this->currency->getPriceSymbol().' '. $this->attention[$this->currency->getPriceField()],
            'code' => 'AT-'.str_pad($this->attention['id'], 6, '0', STR_PAD_LEFT),
            'total_paid' => $this->currency->getPriceSymbol().' '.collect($this->attention->payments)->sum($this->currency->getAmountField()),
            'pending' => $this->calculatePending()
        ]);
    }

    public function procedures(){
        return collect($this->attention->procedures)->map(function($procedure){
            return collect($procedure)->only(['id','name','price','price_USD'])->merge([
                'formatted_price' => $this->currency->getPriceSymbol().' '.$procedure['pivot'][$this->currency->getPriceField()],
                'unformatted_price' => $procedure['pivot'][$this->currency->getPriceField()],
                'amount' => $procedure['pivot']['amount'],
                'discount' => $procedure['pivot']['discount'],
                'subtotal' => $this->currency->getPriceSymbol().' '.
                                number_format($this->calculateSubtotal($procedure),2,'.',','),
            ]);
        });
    }


    public function servicesSubtotal(){
        return $this->currency->getPriceSymbol().' '.collect($this->attention->procedures)->reduce(function($total,$procedure){
           return $total + (($procedure['pivot'][$this->currency->getPriceField()] * $procedure['pivot']['amount'])*((100 - $procedure['pivot']['discount'])/100));
        });
    }

    public function total(){

        return $this->currency->getPriceSymbol().' '.collect($this->attention->procedures)->reduce(function($total,$procedure){
            return $total + (($procedure['pivot'][$this->currency->getPriceField()] * $procedure['pivot']['amount'])*((100 - $procedure['pivot']['discount'])/100));
        }) + $this->attention['unformatted_price'];

    }

    private function unformatted_total() {
        return collect($this->attention->procedures)->reduce(function($total,$procedure){
                return $total + (($procedure['pivot'][$this->currency->getPriceField()] * $procedure['pivot']['amount'])*((100 - $procedure['pivot']['discount'])/100));
            }) + $this->attention['unformatted_price'];

    }

    public function payments(){
        return collect($this->attention->payments)->map(function(Payment $payment){
            return collect($payment)->merge([
                'formatted_amount' => $this->currency->getPriceSymbol().' '.$payment[$this->currency->getAmountField()],
                'formatted_date' => Carbon::parse($payment['created_at'])->format('d F Y g:i A'),
                'method' => $this->paymentMethodBadge($payment['payment_method'])
            ]);
        });
    }

    private function paymentMethodBadge($method){
        return match($method) {
            Payment::EFECTIVO => ['badge badge-success','Efectivo'],
            Payment::TARJETA => ['badge badge-warning','Tarjeta de débito o crédito'],
        };
    }

    private function calculateSubtotal($procedure){
        return ($procedure['pivot']['amount'] * $procedure['pivot'][$this->currency->getPriceField()])
            *((100 - $procedure['pivot']['discount'])/100);
    }

    private function calculatePending(){
        if($this->attention['status'] == Attention::DONE){
            return $this->currency->getPriceSymbol().' '. 0;
        }
        return $this->currency->getPriceSymbol().' '. $this->unformatted_total() - collect($this->attention->payments)->sum($this->currency->getAmountField());
    }




}
