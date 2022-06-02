<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function setCurrency($currency){

        if(!in_array($currency, config('currency.currencies'))){
            return redirect()->back();
        }

        session()->put('currency', $currency);

        return redirect()->back();
    }
}
