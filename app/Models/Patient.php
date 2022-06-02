<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Patient extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','address','phone','observations','document','birthdate','gender','tutor'];

    public const GENDERS = [
        ['id' => 0,'name'=>'Hombre'],
        ['id' => 1,'name'=>'Mujer']
    ];

    protected $appends = ['profile_photo_url'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function boot(){
        parent::boot();

        static::creating(function  ($model)  {
            $model->uuid = (string) Str::uuid();
        });
    }

    // Accessors & Mutators
    // get[NameOfTheAttribute]Attribute
    // profile_photo_url
    public function getProfilePhotoUrlAttribute()
    {
        return 'https://ui-avatars.com/api/?name='.urlencode($this->attributes['name']).'&background=0D8ABC&color=fff';
    }


    //Relationships

    public function appointments()
    {
        return $this->hasMany(Appointment::class)->withTrashed();
    }

    public function attentions(){
        return $this->hasMany(Attention::class);
    }

    public function payments() {
        return $this->hasManyThrough(Payment::class, Attention::class, null, 'paymentable_id')
            ->where('paymentable_type', Attention::class);
    }

    public function scopeSearch($query,$name){
        return $query->where('name','LIKE',"%{$name}%");
    }




}
