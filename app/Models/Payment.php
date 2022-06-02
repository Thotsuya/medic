<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory,SoftDeletes;

    public const EFECTIVO = 0;
    public const TARJETA = 1;

    public const METHODS = [
        self::EFECTIVO => 'Efectivo',
        self::TARJETA => 'Tarjeta',
    ];

    protected $fillable = [
      'currency',
      'description',
      'amount',
      'amount_USD',
      'payment_method',
      'paymentable_id',
      'paymentable_type',
      'unformatted_amount',
    ];

    public function paymentable()
    {
        return $this->morphTo();
    }

}
