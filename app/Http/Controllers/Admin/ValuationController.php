<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValuationRequest;
use App\Models\Patient;
use App\Models\Procedure;
use App\Models\Valuation;
use App\ViewModels\ValuationShowViewModel;
use App\ViewModels\ValuationViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use PDF;

class ValuationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request)
    {
        return inertia('Valuations/Index', [

            'valuations' => new ValuationViewModel(Valuation::with('patient', 'procedures')
                ->search($request->input('search', ''))
                ->searchByPatient($request->input('search', ''))
                ->latest('id')
                ->paginate(8)->withQueryString()),

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
        return Inertia::render('Valuations/Create', [
            'patients' => Patient::all(),
            'procedures' => Procedure::select('id', 'name', 'price', 'price_USD')->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ValuationRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $valuation = Valuation::create($request->validated());
                collect($request->validated()['procedures'])->each(function ($procedure) use ($valuation) {

                    $valuation->procedures()->attach($procedure['id'], [
                        'price' => $procedure['price'],
                        'price_USD' => $procedure['price_USD'],
                        'amount' => $procedure['amount'],
                        'discount' => $procedure['discount'],
                    ]);

                });

            });
        } catch (\Exception $e) {
            return redirect()->route('valuations.create')->with('message', $e->getMessage());
        }

        session()->flash('message', 'Presupuesto creado con éxito');
        return redirect()->route('valuations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function show(Valuation $valuation)
    {
        return \inertia('Valuations/Show',[
            'valuation' => new ValuationShowViewModel($valuation),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit(Valuation $valuation)
    {
        return Inertia::render('Valuations/Edit', [
            'valuation' => $valuation->load('procedures'),
            'patients' => Patient::all(),
            'procedures' => Procedure::select('id', 'name', 'price', 'price_USD')->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ValuationRequest $request, Valuation $valuation)
    {
        try {
            \DB::transaction(function () use ($request, $valuation) {

                $valuation->procedures()->detach();

                $valuation->update($request->validated());

                collect($request->validated()['procedures'])->each(function ($procedure) use ($valuation) {

                    $valuation->procedures()->attach($procedure['id'], [
                        'price' => $procedure['price'],
                        'price_USD' => $procedure['price_USD'],
                        'amount' => $procedure['amount'],
                        'discount' => $procedure['discount'],
                    ]);

                });

            });
        } catch (\Exception $e) {
            return redirect()->route('valuations.create')->with('message', $e->getMessage());
        }

        session()->flash('message', 'Presupuesto actualizado con éxito');
        return redirect()->route('valuations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function report(Valuation $valuation)
    {
        $pdf = PDF::loadView('admin.reports.valuation', [
            'valuation' => $valuation->load('procedures')
        ]);
        return $pdf->stream('Detalles de Presupuesto - ' . 'PT' . str_pad($valuation->id, 8, '0', STR_PAD_LEFT) . '.pdf');
    }
}
