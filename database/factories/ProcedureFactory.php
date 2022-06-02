<?php

namespace Database\Factories;

use App\Services\CurrencyService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Procedure>
 */
class ProcedureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = $this->faker->randomFloat(2, 0, 1000);
        return [
            'name' => $this->faker->word,
            'price' => (new CurrencyService())->getAmountInBaseCurrency($price),
            'price_USD' => (new CurrencyService())->getAmountInTargetCurrency($price)
        ];
    }
}
