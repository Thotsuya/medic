<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ViewModels\DashboardViewModel;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return inertia('Dashboard',[
            'dashboard' => new DashboardViewModel()
        ]);
    }
}
