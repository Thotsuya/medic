<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role' => User::ADMIN,
            'password' => bcrypt('Welcome11'),
        ]);

        $this->call(PermissionSeeder::class);
        $this->call(ProcedureSeeder::class);
        $this->call(PatientSeeder::class);

    }
}
