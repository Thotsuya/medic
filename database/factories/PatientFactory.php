<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'tutor' => $this->faker->name(),
            'document' => $this->faker->randomNumber(8),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'birthdate' => Carbon::now()->subYears(rand(1, 100)),
        ];
    }
}
