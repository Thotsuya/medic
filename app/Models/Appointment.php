<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, softDeletes;

    public const PENDING = 0;
    public const ATTENDED = 1;
    public const CANCELLED = 2;

    protected $fillable = ['title', 'color', 'description', 'user_id', 'status', 'start_date', 'end_date', 'textcolor', 'patient_id'];
    protected $with = ['user'];
    protected $appends = ['start', 'formatted_date', 'formatted_time', 'status_badge','is_today'];

    //Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStartAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('Y-m-d');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('d F Y');
    }

    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('g:i A');
    }

    public function getStatusBadgeAttribute()
    {

        if ($this->trashed()) {
            return '<span class="badge badge-danger">Cancelado</span>';
        }

        return match ($this->attributes['status']) {
            self::PENDING => '<span class="badge badge-warning">Pendiente</span>',
            self::ATTENDED => '<span class="badge badge-success">Atendido</span>',
        };
    }

    public function getIsTodayAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->isToday();
    }

    public function markAsAttended()
    {
        $this->update(['status' => self::ATTENDED]);
    }

}
