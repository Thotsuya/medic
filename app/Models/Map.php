<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;

    protected $fillable = [
        'boton',
        'nombtrata',
        'classbtn1',
        'classbtn2',
        'classbtn3',
        'classbtn4',
        'classbtn5',
        'classbtn6',
        'classbtn7',
        'classbtn8',
        'classbtn9',
        'classbtn10',
        'classbtn11',
        'classbtn12',
        'classbtn13',
        'classbtn14',
        'classbtn15',
        'classbtn16',
        'classbtn17',
        'classbtn18',
        'patient_id'
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function classbtn1() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn1']);
    }

    // Make a method to append # to all the classbtn attributes
    public function classbtn2() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn2']);
    }

    public function classbtn3() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn3']);
    }

    public function classbtn4() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn4']);
    }

    public function classbtn5() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn5']);
    }

    public function classbtn6() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn6']);
    }

    public function classbtn7() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn7']);
    }

    public function classbtn8() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn8']);
    }

    public function classbtn9() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn9']);
    }

    public function classbtn10() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn10']);
    }

    public function classbtn11() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn11']);
    }

    public function classbtn12() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn12']);
    }

    public function classbtn13() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn13']);
    }

    public function classbtn14() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn14']);
    }

    public function classbtn15() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn15']);
    }

    public function classbtn16() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn16']);
    }

    public function classbtn17() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn17']);
    }

    public function classbtn18() : Attribute
    {
        return new Attribute(get: fn($value,$attributes) => '#'.$attributes['classbtn18']);
    }

}
