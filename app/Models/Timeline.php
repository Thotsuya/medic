<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;

    protected $fillable = ['timelineable_id','timelineable_type','content'];

    public function timelineable()
    {
        return $this->morphTo();
    }
}
