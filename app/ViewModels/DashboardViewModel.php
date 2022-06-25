<?php

namespace App\ViewModels;

use App\Models\Appointment;
use App\Models\Attention;
use App\Models\Contact;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Valuation;
use App\Services\CurrencyService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\ViewModels\ViewModel;

class DashboardViewModel extends ViewModel
{
    public $patients;
    public $appointments;
    //public $contacts;
    public $attentions;
    public $payments;
    public $currency;
    public $valuations_count;

    public function __construct()
    {
        $this->patients = Patient::latest('id')->get();

        $this->appointments = Appointment::select('id', 'title', 'description', 'start_date', 'status', 'patient_id')
            ->with('patient')
            ->where('status', Appointment::PENDING)
            ->whereBetween('start_date', [Carbon::today(), Carbon::today()->endOfDay()])
            ->get();
        //$this->contacts = Contact::all();

        $this->attentions = Attention::count();

        $this->currency = new CurrencyService();

        $this->payments = Payment::select(
            DB::raw('sum(amount' . $this->currency->getCurrencyPrefix() . ') as sums'),
            DB::raw("DATE(created_at) as months")
        )
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])
            ->groupBy('months')
            ->get();

        $this->valuations_count = Valuation::count();
    }

    public function patients_count()
    {
        return collect($this->patients)->count();
    }

    public function latest_six_patients()
    {
        return collect($this->patients)->take(6);
    }

    public function today_appointments()
    {
        return collect($this->appointments)->map(function ($appointment) {
            return collect($appointment)->merge([
                'time' => Carbon::parse($appointment->start_date)->translatedFormat('h:i A'),
                'link' => $appointment->patient ? '<a href=' . route('patients.show', $appointment->patient->uuid) . '>' . $appointment->patient->name . '</a>' : $appointment->title
            ]);
        });
    }

    public function today_appointments_count()
    {
        return collect($this->appointments)->count();
    }

//    public function pending_contacts()
//    {
//        return collect($this->contacts)->count();
//    }

    public function attentions()
    {
        return $this->attentions;
    }


    public function payments_labels()
    {
        return collect($this->payments())->pluck('months')->toArray();
    }

    public function payments_values()
    {
        // Collect the payment sums and convert them to the float format
        return collect($this->payments())->pluck('sums')->map(function ($sum) {
            return (float) $sum;
        })->toArray();

    }

    private function payments()
    {
        return collect($this->payments)->map(function ($payment) {
            return collect($payment)->merge([
                'months' => Carbon::parse($payment->months)->translatedFormat('F Y'),
                'sums' => number_format($payment->sums, 2, '.', '')
            ]);
        });
    }

}
