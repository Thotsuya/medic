<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Models\Timeline;
use Carbon\Carbon;

class AppointmentObserver
{
    /**
     * Handle the Appointment "created" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function created(Appointment $appointment)
    {
        //Obtenemos el paciente relacionado a la cita
        $patient = $appointment->patient;
        //Guardamos el evento en el Timeline de este paciente
        $timeline = new Timeline();
        $timeline->content = '
        <i class="fas fa-calendar-plus bg-info"></i>
        <div class="timeline-item">
          <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
          <h3 class="timeline-header">Cita Agendada</h3>

          <div class="timeline-body">
            Cita agendada para el paciente: <b>'.$patient->name.'</b> para el día '.Carbon::parse($appointment->start_date)->translatedFormat('d F Y').' a las '.Carbon::parse($appointment->start_date)->translatedFormat('g:i A').'
            <br/>
            <b>Motivo: </b>'.$appointment->description.'
          </div>
        </div>';
        $patient->timeline()->save($timeline);
    }

    /**
     * Handle the Appointment "updated" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function updated(Appointment $appointment)
    {
        //Obtenemos el paciente relacionado a la cita
        $patient = $appointment->patient;
        //Guardamos el evento en el Timeline de este paciente
        if($patient){
            $timeline = new Timeline();
            $timeline->content = '
                <i class="fas fa-calendar-check bg-green"></i>
                <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
                <h3 class="timeline-header">Cita realizada</h3>

                <div class="timeline-body">
                    Paciente: <b>'.$patient->name.'</b> asistió a consulta agendada para el día '.Carbon::parse($appointment->start_date)->translatedFormat('d F Y').' a las '.Carbon::parse($appointment->start_date)->translatedFormat('g:i A').'
                    <br/>
                    <b>Motivo de Consulta : </b>'.$appointment->description.'
                </div>
                </div>';
            $patient->timeline()->save($timeline);
        }
    }

    /**
     * Handle the Appointment "deleted" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function deleted(Appointment $appointment)
    {
        //
        //Obtenemos el paciente relacionado a la cita
        $patient = $appointment->patient;
        if($patient){
            //Guardamos el evento en el Timeline de este paciente
            $timeline = new Timeline();
            $timeline->content = '
            <i class="fas fa-calendar-times bg-red"></i>
                <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
                <h3 class="timeline-header">Cita Cancelada</h3>

                <div class="timeline-body">
                    Cancelada cita con el paciente <b>'.$appointment->title.'</b>, agendada para el día '.Carbon::parse($appointment->start_date)->translatedFormat('d F Y').' a las '.Carbon::parse($appointment->start_date)->translatedFormat('g:i A').'
                    <br/>
                    <b>Motivo de Consulta: </b>'.$appointment->description.'
                </div>
                </div>';
            $patient->timeline()->save($timeline);
        }
    }

    /**
     * Handle the Appointment "restored" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function restored(Appointment $appointment)
    {
        //
    }

    /**
     * Handle the Appointment "force deleted" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function forceDeleted(Appointment $appointment)
    {
        //
    }
}
