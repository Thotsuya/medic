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

class ValuationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index(Request $request)
    {
        ray()->showQueries();
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
     * @return \Illuminate\Http\Response
     */
    public function store(ValuationRequest $request)
    {
        ray($request->validated());
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
