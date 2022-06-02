<?php

namespace Database\Seeders;

use App\Models\Attention;
use App\Models\Patient;
use App\Models\Procedure;
use App\Models\Valuation;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ray()->queries();

        Patient::factory(30)
            ->create()
            ->each(function ($patient) {

                $procedures = Procedure::all()->random(rand(1, 4))->keyBy('id')->mapWithKeys(function ($procedure) {
                    return [
                        $procedure['id'] => [
                            'price' => $procedure['price'],
                            'price_USD' => $procedure['price_USD'],
                            'amount' => rand(1, 10),
                        ]
                    ];
                });

                Attention::factory(rand(1, 3))->create([
                    'patient_id' => $patient->id,
                    'user_id' => 1
                ])->each(function ($attention) use ($procedures) {
                    $attention->procedures()->attach($procedures->all());
                });


                Valuation::factory(1)->create([
                    'patient_id' => $patient->id,
                    'user_id' => 1,
                ])->each(function ($valuation) use ($procedures) {
                    $valuation->procedures()->attach($procedures->all());
                });


            });
    }
}
