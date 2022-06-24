<?php

namespace App\Observers;

use App\Models\Attention;
use App\Models\Timeline;
use Carbon\Carbon;

class AttentionObserver
{
    /**
     * Handle the Attention "created" event.
     *
     * @param  \App\Models\Attention  $attention
     * @return void
     */
    public function created(Attention $attention)
    {
        //Obtenemos el paciente relacionado a esta atencion
        $patient = $attention->patient;
        $timeline = new Timeline();
        $timeline->content = '
            <i class="fas fa-hand-holding-medical bg-blue"></i>
            <div class="timeline-item">
              <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
              <h3 class="timeline-header"><a href="#">Nueva Atención</a></h3>

              <div class="timeline-body">
                Nueva atención registrada para el paciente: <b>'.$patient->name.'</b><br/>
                <b>Asunto: </b> '.$attention->description.'
              </div>
              <div class="timeline-footer">
                <a href="'.route('attentions.show',$attention).'" class="btn btn-primary btn-sm">Ver Detalles</a>
              </div>
            </div>';
        $patient->timeline()->save($timeline);
    }

    /**
     * Handle the Attention "updated" event.
     *
     * @param  \App\Models\Attention  $attention
     * @return void
     */
    public function updated(Attention $attention)
    {
        //
        //Obtenemos el paciente relacionado a esta atencion
        $patient = $attention->patient;
        $timeline = new Timeline();
        $timeline->content = '
            <i class="fas fa-hand-holding-medical bg-warning"></i>
            <div class="timeline-item">
              <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
              <h3 class="timeline-header">Se <a href="#">Modificó</a> el plan de Tratamiento</h3>

              <div class="timeline-body">
                Se modificó el plan de tratamiento del paciente: <b>'.$patient->name.'</b><br/>
                <b>Asunto: </b> '.$attention->description.'
              </div>
              <div class="timeline-footer">
                <a href="'.route('attentions.show',$attention).'" class="btn btn-primary btn-sm">Ver Detalles</a>
              </div>
            </div>';
        $patient->timeline()->save($timeline);
    }

    /**
     * Handle the Attention "deleted" event.
     *
     * @param  \App\Models\Attention  $attention
     * @return void
     */
    public function deleted(Attention $attention)
    {
        //
        $patient = $attention->patient;
        $timeline = new Timeline();
        $timeline->content = '
            <i class="fas fa-hand-holding-medical bg-danger"></i>
            <div class="timeline-item">
              <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
              <h3 class="timeline-header">Se ha <a href="#">dado de baja</a> el plan de Tratamiento</h3>

              <div class="timeline-body">
                Se ha dado de baja el plan de tratamiento del paciente: <b>'.$patient->name.'</b><br/>
                <b>Asunto: </b> '.$attention->description.'
              </div>
            </div>';
        $patient->timeline()->save($timeline);
    }

    /**
     * Handle the Attention "restored" event.
     *
     * @param  \App\Models\Attention  $attention
     * @return void
     */
    public function restored(Attention $attention)
    {
        //
        $patient = $attention->patient;
        $timeline = new Timeline();
        $timeline->content = '
            <i class="fas fa-hand-holding-medical bg-info"></i>
            <div class="timeline-item">
              <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
              <h3 class="timeline-header">Se ha <a href="#">restaurado</a> el plan de Tratamiento</h3>

              <div class="timeline-body">
                Se ha restaurado el plan de tratamiento del paciente: <b>'.$patient->name.'</b><br/>
                <b>Asunto: </b> '.$attention->description.'
              </div>
            </div>
          ';
        $patient->timeline()->save($timeline);
    }

    /**
     * Handle the Attention "force deleted" event.
     *
     * @param  \App\Models\Attention  $attention
     * @return void
     */
    public function forceDeleted(Attention $attention)
    {
        //
    }
}
