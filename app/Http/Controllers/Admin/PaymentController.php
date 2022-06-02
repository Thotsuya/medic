<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentStoreRequest;
use App\Models\Attention;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(PaymentStoreRequest $request)
    {
        $attention = Attention::find($request->validated()['attention_id']);
        $attention->payments()->create($request->all());

        $attention->updateStatus();

        session()->flash('message', 'Pago generado correctamente');
        return redirect()->route('attentions.show', $attention);

    }

    public function destroy(Request $request, Payment $payment)
    {
        $attention = Attention::where('id',$payment->paymentable_id)->first();
        $payment->delete();
        $attention->updateStatus();
        session()->flash('message', 'Pago eliminado correctamente');
        return redirect()->back();
    }
}
