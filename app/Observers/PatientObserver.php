<?php

namespace App\Observers;

use App\Models\Patient;
use App\Models\Timeline;
use Carbon\Carbon;

class PatientObserver
{
    public function created(Patient $patient)
    {
        //
        $timeline = new Timeline();
        $timeline->content = '<div>
        <i class="fas fa-user bg-green"></i>
        <div class="timeline-item">
          <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
          <h3 class="timeline-header no-border">Paciente <a href="#">'.$patient->name.'</a> ha sido registrado en el sistema</h3>
        </div>
        </div>';
        $patient->timeline()->save($timeline);
        //$this->CrearOdontograma($patient);
    }

    /**
     * Handle the Patient "updated" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function updated(Patient $patient)
    {
        //
        $timeline = new Timeline();
        $timeline->content = '<div>
        <i class="fas fa-user bg-info"></i>
        <div class="timeline-item">
          <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
          <h3 class="timeline-header no-border">Se modificaron los datos del paciente <a href="#">'.$patient->name.'</a></h3>
        </div>
        </div>';
        $patient->timeline()->save($timeline);
    }

    /**
     * Handle the Patient "deleted" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function deleted(Patient $patient)
    {
        //
        $timeline = new Timeline();
        $timeline->content = '<div>
        <i class="fas fa-user bg-danger"></i>
        <div class="timeline-item">
          <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
          <h3 class="timeline-header no-border">Paciente <a href="#">'.$patient->name.'</a> ha sido dado de baja</h3>
        </div>
        </div>';
        $patient->timeline()->save($timeline);
    }

    /**
     * Handle the Patient "restored" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function restored(Patient $patient)
    {
        //
        $timeline = new Timeline();
        $timeline->content = '<div>
        <i class="fas fa-user bg-info"></i>
        <div class="timeline-item">
          <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
          <h3 class="timeline-header no-border">Paciente <a href="#">'.$patient->name.'</a> ha sido dado de alta</h3>
        </div>
        </div>';
        $patient->timeline()->save($timeline);
    }

}
