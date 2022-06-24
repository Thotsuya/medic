<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\Timeline;
use App\Services\CurrencyService;
use Carbon\Carbon;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function created(Payment $payment)
    {

        $attention = $payment->paymentable_type::find($payment->paymentable_id);
        ray($attention);

        $currency = new CurrencyService();

        $timeline = new Timeline();
        $timeline->content = '
        <i class="fas fa-money-check bg-yellow"></i>
        <div class="timeline-item">
          <span class="time"><i class="fas fa-clock"></i> ' . Carbon::now()->translatedFormat('g:i A') . '</span>
          <h3 class="timeline-header">Nuevo <a href="#">Pago</a> generado para plan de tratamiento</h3>
          <div class="timeline-body">
            Se registró un <b>pago</b> para el siguiente plan de tratamiento:<br/>
            <b>Tratamiento: </b> ' . $attention->description . ' <br/>
            <b>Paciente: </b> ' . $attention->patient->name . '</br>
            <b>Monto: </b>' . $currency->getPriceSymbol() . ' ' . $payment->{$currency->getAmountField()} . ' <br/>
          </div>
          <div class="timeline-footer">
            <a href="' . route('attentions.show', $attention) . '" class="btn btn-warning btn-sm">Ver Detalles</a>
          </div>
        </div>';

        $attention->patient->timeline()->save($timeline);

    }

    /**
     * Handle the Payment "updated" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "deleted" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        //
//        $attention = Attention::find($payment->attention->id);
//        if($attention->payments_count == 0){
//            $attention->estado_pago = Attention::PENDIENTE;
//        }else{
//            $attention->estado_pago = Attention::PROCESO;
//        }
//        $attention->saveQuietly();
    }

    /**
     * Handle the Payment "restored" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     *
     * @param \App\Models\Payment $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        //
    }
}
