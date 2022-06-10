<?php

namespace App\Models;

use App\Services\CurrencyService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Attention extends Model
{
    use HasFactory;

    public const PENDING = 0;
    public const PROGRESS = 1;
    public const DONE = 2;
    public const CANCELLED = 3;

    protected $fillable = [
        'user_id',
        'patient_id',
        'status',
        'description',
        'start_date',
        'price',
        'price_USD',
        'observations'
    ];

    protected $appends = [
        'code',
        'short_description',
        'start_date_formatted',
        'status_badge',
        'unformatted_price',
        'price_formatted',
        'has_payments',
        'subtotal_unformatted',
        'total_unformatted',
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


    // Relationships

    public function procedures()
    {
        return $this->belongsToMany(Procedure::class)
            ->withPivot(['price', 'price_USD', 'amount', 'discount'])
            ->withTimestamps();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    // Accessors

    public function getStatusBadgeAttribute()
    {
        return match ($this->attributes['status']) {
            Attention::PENDING => ['badge' => 'badge-warning', 'label' => 'Pendiente'],
            Attention::PROGRESS => ['badge' => 'badge-info', 'label' => 'En Proceso'],
            Attention::DONE => ['badge' => 'badge-success', 'label' => 'Realizada'],
            Attention::CANCELLED => ['badge' => 'badge-danger', 'label' => 'Cancelada'],
        };

    }

    public function getStartDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date']);
    }

    public function code() : Attribute
    {
        return new Attribute(
          get: fn() => 'AT-'.str_pad($this->id, 6, '0', STR_PAD_LEFT)
        );
    }

    public function shortDescription() : Attribute
    {
        return new Attribute(
          get: fn() => Str::limit($this->attributes['description'], 40, '...')
        );
    }
    
    public function getStartDateFormattedAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('d F Y');
    }

    public function getUnformattedPriceAttribute()
    {
        return $this->attributes[(new CurrencyService())->getPriceField()];
    }

    public function getHasPaymentsAttribute()
    {
        return $this->payments->count() > 0;
    }

    public function getPriceFormattedAttribute()
    {
        return (new CurrencyService())->getPriceSymbol() . ' ' . $this->attributes[(new CurrencyService())->getPriceField()];
    }

    public function getSubtotalUnformattedAttribute()
    {
        $currency = new CurrencyService();
        return $currency->getPriceSymbol() . ' ' . collect($this->procedures)->reduce(function ($total, $procedure) use ($currency) {
                return $total + (($procedure->pivot->{$currency->getPriceField()} * $procedure->pivot->amount) * ((100 - $procedure->pivot->discount) / 100));
            }, 0);
    }

    public function getTotalUnformattedAttribute()
    {
        $currency = new CurrencyService();
        return collect($this->procedures)->reduce(function ($total, $procedure) use ($currency) {
                return $total + (($procedure->pivot->{$currency->getPriceField()} * $procedure->pivot->amount) * ((100 - $procedure->pivot->discount) / 100));
            }, 0) + $this->attributes[(new CurrencyService())->getPriceField()];
    }

    public function updateStatus()
    {

        if ($this->payments->count() > 0) {
            $this->update(['status' => self::PROGRESS]);
        } else {
            $this->update(['status' => self::PENDING]);
        }

        if (number_format($this->calculateTotalPaid(), 2) >= number_format($this->calculateAttentionTotal(), 2)) {
            $this->update(['status' => self::DONE]);
        }


    }

    private function calculateTotalPaid()
    {
        $currency = new CurrencyService();
        return collect($this->payments)->sum($currency->getAmountField());
    }

    private function calculateAttentionTotal()
    {
        $currency = new CurrencyService();
        return collect($this->procedures)->reduce(function ($total, $procedure) use ($currency) {
                return $total + (($procedure['pivot'][$currency->getPriceField()] * $procedure['pivot']['amount']) * ((100 - $procedure['pivot']['discount']) / 100));
            }) + $this->attributes[$currency->getPriceField()];
    }

    // Scopes

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


}
