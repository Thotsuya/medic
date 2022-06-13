<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tooth extends Model
{
    use HasFactory;

    protected $fillable = ['canvar'];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

}
