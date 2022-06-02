<?php

namespace App\ViewModels;

use App\Models\Valuation;
use App\Services\CurrencyService;
use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class ValuationShowViewModel extends ViewModel
{
    public $currency;
    public function __construct(public Valuation $valuation)
    {
        $this->currency = new CurrencyService();
        $valuation->load('patient')
                    ->load('procedures');
    }

    public function data()
    {
        return collect($this->valuation)->merge([
            'formatted_price' => $this->currency->getPriceSymbol().' '. $this->valuation[$this->currency->getPriceField()],
            'start_date_formatted' => Carbon::parse($this->valuation['created_at'])->translatedFormat('l d F Y'),
            'code' => 'P-'.str_pad($this->valuation['id'], 6, '0', STR_PAD_LEFT)
        ]);
    }

    public function procedures(){
        return collect($this->valuation->procedures)->map(function($procedure){
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
        return $this->currency->getPriceSymbol().' '.collect($this->valuation->procedures)->reduce(function($total,$procedure){
                return $total + (($procedure['pivot'][$this->currency->getPriceField()] * $procedure['pivot']['amount'])*((100 - $procedure['pivot']['discount'])/100));
            });
    }

    public function total(){

        return $this->currency->getPriceSymbol().' '.collect($this->valuation->procedures)->reduce(function($total,$procedure){
                return $total + (($procedure['pivot'][$this->currency->getPriceField()] * $procedure['pivot']['amount'])*((100 - $procedure['pivot']['discount'])/100));
            }) + $this->valuation[$this->currency->getPriceField()];

    }


    private function calculateSubtotal($procedure){
        return ($procedure['pivot']['amount'] * $procedure['pivot'][$this->currency->getPriceField()])
            *((100 - $procedure['pivot']['discount'])/100);
    }

}
