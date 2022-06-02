<?php

namespace Database\Factories;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Valuation>
 */
class ValuationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $currency = new CurrencyService();
        $amount = $this->faker->randomFloat(0,100,1000);
        return [
            'description' => $this->faker->text,
            'price' => $currency->getAmountInBaseCurrency($amount),
            'price_USD' => $currency->getAmountInTargetCurrency($amount),
        ];
    }
}
