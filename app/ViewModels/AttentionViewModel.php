<?php

namespace App\ViewModels;

use App\Models\Attention;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class AttentionViewModel extends ViewModel
{
    public function __construct(public LengthAwarePaginator $attentions)
    {
    }

    public function data(){
        return collect($this->attentions->all())->map(function($attention){
            return collect($attention)->merge([
                'code' => 'AT-'.str_pad($attention['id'], 6, '0', STR_PAD_LEFT),
                'status' => $this->getStatusBadge($attention['status']),
                'description' => \Str::limit($attention['description'], 30, '...'),
            ]);
        });
    }

    public function links(){
        return $this->attentions->linkCollection();
    }

    private function getStatusBadge($status){
        return match($status) {
            Attention::PENDING => ['badge' => 'badge-warning','label' => 'Pendiente'],
            Attention::PROGRESS => ['badge' => 'badge-info','label' => 'En Proceso'],
            Attention::DONE => ['badge' => 'badge-success','label' => 'Realizada'],
            Attention::CANCELLED => ['badge' => 'badge-danger','label' => 'Cancelada'],
        };

    }
}
