<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Patient extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','address','phone','observations','document','birthdate','gender','tutor','user_id'];

    public const GENDERS = [
        ['id' => 0,'name'=>'Hombre'],
        ['id' => 1,'name'=>'Mujer']
    ];

    protected $appends = ['profile_photo_url','is_adult'];


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

    public function IsAdult() : Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => Carbon::parse($attributes['birthdate'])->diffInYears() >= 18
        );
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

    public function valuations(){
        return $this->hasMany(Valuation::class);
    }

    public function documents(){
        return $this->morphMany(Document::class,'documentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }

    public function timeline(){
        return $this->morphMany(Timeline::class,'timelineable');
    }

    public function teeth(){
        return $this->hasOne(Tooth::class);
    }

    public function map(){
        return $this->hasOne(Map::class);
    }

    public function scopeSearch($query,$name){
        return $query->where('name','LIKE',"%{$name}%");
    }





}
