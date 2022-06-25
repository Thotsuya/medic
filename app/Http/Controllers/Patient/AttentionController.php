<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Attention;
use App\ViewModels\AttentionShowViewModel;
use Inertia\Inertia;

class AttentionController extends Controller
{
    public function show(Attention $attention){
        return Inertia::render('Client/Attentions/Show', [
            'attention' => new AttentionShowViewModel($attention),
        ]);
    }
}
