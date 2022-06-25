<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\User;

class AppointmentController extends Controller
{
    public function store(StoreAppointmentRequest $request){
        // Find the first user whose role is Administrator
        $user = User::where('role','admin')->first();
        $user->appointments()->create($request->validated());
        session()->flash('message', 'Cita creada correctamente');
        return redirect()->route('client.dashboard');
    }
}
