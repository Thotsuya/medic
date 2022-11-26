<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\Attention;
use App\Models\Patient;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Patient::observe(\App\Observers\PatientObserver::class);
        Appointment::observe(\App\Observers\AppointmentObserver::class);
        Attention::observe(\App\Observers\AttentionObserver::class);
        Payment::observe(\App\Observers\PaymentObserver::class);

        Carbon::setLocale('es');

        Inertia::share('flash', function () {
            return [
                'message' => \Session::get('message'),
            ];
        });

        Inertia::share('currency',function(){
            return [
                'currency' => \Session::get('currency'),
                'currencies' => [
                    config('currency.base_currency.code'),
                    config('currency.target_currency.code'),
                ]
            ];
        });

        Inertia::share('permissions',function(){
            return auth()->check() ?  auth()->user()->getAllPermissions()->map(function($permission){
                return $permission->name;
            }) : [];
        });

    }
}
