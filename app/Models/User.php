<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public const PATIENT = 'patient';
    public const ADMIN = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['user_image'];


    public function getUserImageAttribute(){
        return 'https://ui-avatars.com/api/?name='.urlencode($this->attributes['name']).'&color=7F9CF5&background=EBF4FF';
    }

    //Relationships
    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function attentions(){
        return $this->hasMany(Attention::class);
    }

    public function valuations(){
        return $this->hasMany(Valuation::class);
    }

    public function patient(){
        return $this->hasOne(Patient::class);
    }

}
