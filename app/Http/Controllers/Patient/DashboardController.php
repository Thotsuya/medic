<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Client/Dashboard',[
            'patient' => auth()->user()->patient,
            'attentions' => auth()->user()->patient->attentions,
            'valuations' => auth()->user()->patient->valuations,
            'appointments' => auth()->user()->patient->appointments->load('user'),
        ]);
    }
}
