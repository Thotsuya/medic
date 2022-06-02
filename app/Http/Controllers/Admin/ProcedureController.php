<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProcedureRequest;
use App\Models\Procedure;
use App\ViewModels\ProcedureViewModel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Procedures/Index',[
            'procedures' => new ProcedureViewModel(Procedure::query()
                                    ->when($request->search,fn($query) => $query->where('name', 'like', "%{$request->search}%"))
                                    ->paginate(10)
                                    ->withQueryString()),
            'search' => $request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProcedureRequest $request)
    {
        Procedure::create($request->validated());
        session()->flash('message', 'Procedure created successfully.');
        return redirect()->route('procedures.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProcedureRequest $request, Procedure $procedure)
    {
        $procedure->update($request->validated());
        session()->flash('message', 'Procedure updated successfully.');
        return redirect()->route('procedures.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procedure $procedure)
    {
        $procedure->delete();
        session()->flash('message', 'Procedure deleted successfully.');
        return redirect()->route('procedures.index');
    }
}
