<?php

namespace App\ViewModels;

use App\Services\CurrencyService;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class ProcedureViewModel extends ViewModel
{
    private $currency;
    public function __construct(public LengthAwarePaginator $procedures)
    {
        $this->currency = new CurrencyService();
    }

    public function data(){
        return collect($this->procedures->all())->map(function($procedure){
            return collect($procedure)->merge([
               'unformatted_price' => $procedure[$this->currency->getPriceField()],
               'formatted_price' => $this->currency->getPriceSymbol().' '.$procedure[$this->currency->getPriceField()],
            ]);
        });
    }

    public function links(){
        return $this->procedures->linkCollection();
    }
}
