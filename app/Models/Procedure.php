<?php

namespace App\Models;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedure extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = [
        'name',
        'price',
        'price_USD',
    ];

    protected $appends = [
        'price_formatted',
        'price_unformatted',
    ];

    // Relationships

    public function attentions(){
        return $this->belongsToMany(Attention::class);
    }

    public function valuations(){
        return $this->belongsToMany(Valuation::class);
    }

    // Accessors

    public function getPriceFormattedAttribute(){
        $currency = new CurrencyService();
        return $currency->getPriceSymbol().' '.$this->{$currency->getPriceField()};
    }

    public function getPriceUnformattedAttribute(){
        $currency = new CurrencyService();
        return $this->{$currency->getPriceField()};
    }



}
