<?php

namespace App\ViewModels;

use App\Models\Patient;
use App\Models\Payment;
use App\Services\CurrencyService;
use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class PatientShowViewModel extends ViewModel
{

    public $currency;

    public function __construct(public Patient $patient){
        $patient->load('appointments')
                 ->load('attentions')
                  ->load('payments')
                  ->load('documents');
        $this->currency = new CurrencyService();
    }

    public function data(){
        return collect($this->patient)->merge([
           'code' => 'PAT-'.str_pad($this->patient->id, 6, '0', STR_PAD_LEFT),
           'age' => Carbon::parse($this->patient->birthdate)->age,
           'registration_date_formatted' => Carbon::parse($this->patient->created_at)->format('d F Y'),
        ]);
    }

    public function payments(){
        return collect($this->patient->payments)->map(function(Payment $payment){
            return collect($payment)->merge([
                'formatted_amount' => $this->currency->getPriceSymbol().' '.$payment[$this->currency->getAmountField()],
                'formatted_date' => \Carbon\Carbon::parse($payment['created_at'])->format('d F Y g:i A'),
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

}
