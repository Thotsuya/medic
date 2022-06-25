<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OdontogramRequest;
use App\Models\Map;
use App\Models\Patient;
use Illuminate\Http\Request;

class OdontogramController extends Controller
{
    //
    public function index(Patient $patient)
    {
        return inertia('Odontogram/Index',[
            'patient' => $patient,
            'odontograma' => $patient->teeth,
            'tratamientoodonto' => $patient->map
        ]);
    }

    public function rules(OdontogramRequest $request){

        $map = Map::where('patient_id',$request->validated()['patient_id'])->first();
        $map->update($request->validated());
        return redirect()->route('patients.odontogram',$map->patient);
    }

    public function update(Request $request,Patient $patient){

        $patient->teeth->update([
            'canvar' => $request->canvar,
        ]);

        return redirect()->route('patients.odontogram',$patient);
    }
}
