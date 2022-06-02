<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAttentionRequest;
use App\Models\Valuation;

class ValuationUpdateController extends Controller
{
    public function update(UpdateAttentionRequest $request, Valuation $valuation)
    {
        ray($request->validated());
        try {

            \DB::transaction(function() use($request,$valuation){
                $valuation->procedures()->detach();

                collect($request->validated()['procedures'])->each(function($procedure) use($valuation){

                    $valuation->procedures()->attach($procedure['id'],[
                        'price' => $procedure['price'],
                        'price_USD' => $procedure['price_USD'],
                        'amount' => $procedure['amount'],
                        'discount' => $procedure['discount'],
                    ]);

                });


            });

        }catch (\Exception $e) {
            ray($e->getMessage());
            return redirect()->back()->with('errors', $e->getMessage());
        }

        session()->flash('message', 'Presupuesto actualizado con exito.');
        return redirect()->route('valuations.show', $valuation);
    }
}
