<?php

namespace App\ViewModels;

use App\Models\Patient;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class PatientViewModel extends ViewModel
{


    public function __construct(public LengthAwarePaginator $patients){

    }

    public function data(){
        return collect($this->patients->all())->map(function($patient){
            return collect($patient)->merge([
                'foo' => 'bar',
                'code' => 'PAT-'.str_pad($patient['id'],6,'0',STR_PAD_LEFT),
                'badge' => $this->getActiveBadge($patient)
            ]);
        });
    }

    public function links(){
        return $this->patients->linkCollection();
    }

    private function getActiveBadge($patient){
        return !$patient->trashed()
            ? '<span class="badge badge-success">Activo</span>'
            : '<span class="badge badge-danger">Inactivo</span>';
    }

}
