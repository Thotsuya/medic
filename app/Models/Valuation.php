<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Valuation extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'observations',
        'patient_id',
        'user_id',
        'price',
        'price_USD',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }


    public function procedures(){
        return $this->belongsToMany(Procedure::class)->withPivot(['amount','discount','price','price_USD'])->withTimestamps();
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function scopeSearch($query, $search){
        return $query->where('description','like',"%".$search."%");
    }

    public function scopeSearchByPatient($query, $patient){
        return $query->orWhereHas('patient', function ($query) use ($patient) {
            $query->where('name', 'like', '%' . $patient . '%');
        });
    }



}
