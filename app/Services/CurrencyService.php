<?php

namespace App\Services;
use AmrShawky\LaravelCurrency\Facade\Currency;

class CurrencyService
{

    public $baseCurrency;
    public $targetCurrency;
    public $currency;

    public function __construct()
    {
        $this->baseCurrency = config('currency.base_currency.code');
        $this->targetCurrency = config('currency.target_currency.code');

        $this->currency = \Cache::remember('currency', 60 * 60 * 24, function () {
            return Currency::convert()
                            ->from($this->targetCurrency)
                            ->to($this->baseCurrency)
                            ->amount(1)
                            ->get();
        });

    }

    public function getAmountInBaseCurrency($amount)
    {
        if (session()->has('currency')) {
            if (session('currency') == $this->baseCurrency) {
                return $amount;
            } else {
                return number_format($amount * $this->currency,2,'.','');
            }
        }else{
            return $amount;
        }
    }


    public function getAmountInTargetCurrency($amount)
    {
        if (session()->has('currency')) {
            if (session('currency') == $this->targetCurrency) {
                return $amount;
            } else {
                return number_format($amount / $this->currency,2,'.','');
            }
        }else{
            return number_format($amount / $this->currency,2,'.','');
        }
    }

    public function getAmountField(){
        if (session()->has('currency')) {
            if (session('currency') == $this->baseCurrency) {
                return 'amount';
            } else {
                return 'amount_'.config('currency.target_currency.code');
            }
        }else{
            return 'amount';
        }
    }

    public function getPriceField(){
        if (session()->has('currency')) {
            if (session('currency') == $this->baseCurrency) {
                return 'price';
            } else {
                return 'price_'.config('currency.target_currency.code');
            }
        }else{
            return 'price';
        }
    }

    public function getPriceSymbol(){
        if (session()->has('currency')) {
            if (session('currency') == $this->baseCurrency) {
                return config('currency.base_currency.symbol');
            } else {
                return config('currency.target_currency.symbol');
            }
        }else{
            return config('currency.base_currency.symbol');
        }
    }



}
