<?php

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $appends = [
        'unformatted_price',
        'code'
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string)Str::uuid();
        });
    }


    public function procedures()
    {
        return $this->belongsToMany(Procedure::class)->withPivot(['amount', 'discount', 'price', 'price_USD'])->withTimestamps();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('description', 'like', "%" . $search . "%");
    }

    public function scopeSearchByPatient($query, $patient)
    {
        return $query->orWhereHas('patient', function ($query) use ($patient) {
            $query->where('name', 'like', '%' . $patient . '%');
        });
    }

    public function unformattedPrice(): Attribute
    {
        return new Attribute(
            get: fn() => $this->{(new CurrencyService())->getPriceField()}
        );
    }

    public function code(): Attribute
    {
        return new Attribute(
            get: fn() => 'P-'.str_pad($this->id, 6, '0', STR_PAD_LEFT)
        );
    }


}
