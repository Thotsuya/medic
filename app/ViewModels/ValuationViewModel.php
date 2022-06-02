<?php

namespace App\ViewModels;

use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class ValuationViewModel extends ViewModel
{
    public function __construct(public LengthAwarePaginator $attentions)
    {
    }

    public function data(){
        return collect($this->attentions->all())->map(function($attention){
            return collect($attention)->merge([
                'code' => 'P-'.str_pad($attention['id'], 6, '0', STR_PAD_LEFT),
                'description' => \Str::limit($attention['description'], 30, '...'),
            ]);
        });
    }

    public function links(){
        return $this->attentions->linkCollection();
    }

}
