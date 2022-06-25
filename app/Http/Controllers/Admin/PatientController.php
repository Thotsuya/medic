<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Models\Patient;
use App\Models\Timeline;
use App\ViewModels\PatientShowViewModel;
use App\ViewModels\PatientViewModel;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Patients/Index', [
            'patients' => new PatientViewModel(Patient::query()
                ->search($request->search)
                ->latest('id')
                ->paginate(8)
                ->withQueryString()),
            'search' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Patients/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePatientRequest $request)
    {
        //Store the request
        Patient::create($request->validated());
        session()->flash('message', 'Patient created successfully.');
        return redirect()->route('patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function show(Request $request, Patient $patient)
    {
        $timeline = Timeline::where('timelineable_id', $patient->id)
            ->where('timelineable_type', Patient::class)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->translatedFormat('d F Y');
            })
            ->toArray();

        ray($timeline);

        $paginate = 1;
        $page = $request->page ?? 1;
        $offSet = ($page * $paginate) - $paginate;
        $itemsForCurrentPage = array_slice($timeline, $offSet, $paginate, true);
        $timelines = new LengthAwarePaginator($itemsForCurrentPage, count($timeline), $paginate, $page, ['path' => route('patients.show', $patient->uuid)]);


        return Inertia::render('Patients/Show', [
            'patient' => new PatientShowViewModel($patient),
            'timelines' => $timelines,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StorePatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());
        session()->flash('message', 'Patient updated successfully.');
        return redirect()->route('patients.show', $patient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        session()->flash('message','Paciente dado de baja correctamente.');
        return redirect()->route('patients.index');
    }
}
