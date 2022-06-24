<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','patient_id','content'];
    protected $appends = ['footer_text'];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function FooterText() : Attribute
    {
        return new Attribute(
             get: fn ($value, $attributes) => 'Por <cite title="Autor">'.$this->user->name.' el dia '.$this->created_at->translatedFormat('D d M').' a las '.$this->created_at->translatedFormat('g:i A').'</cite>'
        );
    }


}
