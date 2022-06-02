<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAttentionRequest;
use App\Models\Attention;
use Illuminate\Http\Request;

class AttentionUpdateController extends Controller
{
    public function update(UpdateAttentionRequest $request, Attention $attention)
    {
        ray($request->validated());
        try {

            \DB::transaction(function() use($request,$attention){
                $attention->procedures()->detach();

                collect($request->validated()['procedures'])->each(function($procedure) use($attention){

                    $attention->procedures()->attach($procedure['id'],[
                        'price' => $procedure['price'],
                        'price_USD' => $procedure['price_USD'],
                        'amount' => $procedure['amount'],
                        'discount' => $procedure['discount'],
                    ]);

                });

                $attention->updateStatus();

            });

        }catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }

        session()->flash('message', 'Plan de tratamiento actualizado con exito.');
        return redirect()->route('attentions.show', $attention);

    }
}
