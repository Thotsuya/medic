<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Valuation;
use App\ViewModels\ValuationShowViewModel;

class ValuationController extends Controller
{
    public function show(Valuation $valuation)
    {
        return \inertia('Client/Valuations/Show',[
            'valuation' => new ValuationShowViewModel($valuation),
        ]);
    }
}
