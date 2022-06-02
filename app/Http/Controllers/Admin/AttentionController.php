<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttentionRequest;
use App\Models\Attention;
use App\Models\Patient;
use App\Models\Procedure;
use App\ViewModels\AttentionShowViewModel;
use App\ViewModels\AttentionViewModel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PDF;

class AttentionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request)
    {
        return inertia('Attentions/Index', [
            'attentions' => new AttentionViewModel(Attention::with('patient','procedures','payments')
                ->search($request->input('search', ''))
                ->searchByPatient($request->input('search', ''))
                ->latest('id')
                ->paginate(8)
                ->withQueryString()),
            'search' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Attentions/Create', [
            'patients' => Patient::all(),
            'procedures' => Procedure::select('id', 'name', 'price', 'price_USD')->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttentionRequest $request)
    {
        try {
            \DB::transaction(function () use ($request) {

                $attention = Attention::create($request->validated());
                collect($request->validated()['procedures'])->each(function ($procedure) use ($attention) {

                    $attention->procedures()->attach($procedure['id'], [
                        'price' => $procedure['price'],
                        'price_USD' => $procedure['price_USD'],
                        'amount' => $procedure['amount'],
                        'discount' => $procedure['discount'],
                    ]);

                });

            });
        } catch (\Exception $e) {
            return redirect()->route('attentions.create')->with('message', $e->getMessage());
        }

        session()->flash('message', 'Plan de tratamiento creado con éxito');
        return redirect()->route('attentions.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Attention $attention
     * @return \Inertia\Response
     */
    public function show(Attention $attention)
    {
        return Inertia::render('Attentions/Show', [
            'attention' => new AttentionShowViewModel($attention),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Attention $attention
     * @return \Inertia\Response
     */
    public function edit(Attention $attention)
    {
        return Inertia::render('Attentions/Edit', [
            'attention' => $attention->load('procedures'),
            'patients' => Patient::all(),
            'procedures' => Procedure::select('id', 'name', 'price', 'price_USD')->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Attention $attention
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAttentionRequest $request, Attention $attention)
    {

        try {
            \DB::transaction(function () use ($request, $attention) {

                $attention->procedures()->detach();

                $attention->update($request->validated());

                collect($request->validated()['procedures'])->each(function ($procedure) use ($attention) {

                    $attention->procedures()->attach($procedure['id'], [
                        'price' => $procedure['price'],
                        'price_USD' => $procedure['price_USD'],
                        'amount' => $procedure['amount'],
                        'discount' => $procedure['discount'],
                    ]);

                });

            });
        } catch (\Exception $e) {
            return redirect()->route('attentions.create')->with('message', $e->getMessage());
        }

        session()->flash('message', 'Plan de tratamiento actualizado con éxito');
        return redirect()->route('attentions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Attention $attention
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attention $attention)
    {
        //
    }

    public function report(Attention $attention)
    {
        $pdf = PDF::loadView('admin.reports.attention', [
            'attention' => new AttentionShowViewModel($attention),
        ]);
        return $pdf->stream('Detalles de Atencion - ' . 'AT' . str_pad($attention->id, 8, '0', STR_PAD_LEFT) . '.pdf');
    }
}
