<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentOperationsController extends Controller
{
    public function updateAppointmentStatus(Appointment $appointment, Request $request)
    {
        $appointment->markAsAttended();
        session()->flash('message', 'Appointment status updated successfully');
        return redirect()->route('patients.show', $appointment->patient);
    }

    public function restoreAppointment($id){
        $appointment = Appointment::withTrashed()->findOrFail($id);
        $appointment->restore();
        session()->flash('message', 'Appointment restored successfully');
        return redirect()->route('patients.show', $appointment->patient);
    }
}
