<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'Ver Dashboard']);

        Permission::create(['name' => 'Ver Usuarios']);
        Permission::create(['name' => 'Crear Usuarios']);
        Permission::create(['name' => 'Editar Usuarios']);
        Permission::create(['name' => 'Eliminar Usuarios']);

        Permission::create(['name' => 'Ver Roles']);
        Permission::create(['name' => 'Crear Roles']);
        Permission::create(['name' => 'Editar Roles']);
        Permission::create(['name' => 'Eliminar Roles']);


        Permission::create(['name' => 'Ver Pacientes']);
        Permission::create(['name' => 'Crear Pacientes']);
        Permission::create(['name' => 'Editar Pacientes']);
        Permission::create(['name' => 'Eliminar Pacientes']);


        Permission::create(['name' => 'Ver Citas']);
        Permission::create(['name' => 'Crear Citas']);
        Permission::create(['name' => 'Editar Citas']);
        Permission::create(['name' => 'Eliminar Citas']);

        Permission::create(['name' => 'Ver Servicios']);
        Permission::create(['name' => 'Crear Servicios']);
        Permission::create(['name' => 'Editar Servicios']);
        Permission::create(['name' => 'Eliminar Servicios']);

        Permission::create(['name' => 'Ver Atenciones']);
        Permission::create(['name' => 'Crear Atenciones']);
        Permission::create(['name' => 'Editar Atenciones']);
        Permission::create(['name' => 'Eliminar Atenciones']);

        Permission::create(['name' => 'Ver Cotizaciones']);
        Permission::create(['name' => 'Crear Cotizaciones']);
        Permission::create(['name' => 'Editar Cotizaciones']);
        Permission::create(['name' => 'Eliminar Cotizaciones']);

        Permission::create(['name' => 'Ver Pagos']);

        Role::create(['name' => 'Administrador'])->givePermissionTo(Permission::all()->modelKeys());
        Role::create(['name' => 'Doctor'])->givePermissionTo(Permission::all()->modelKeys());
        Role::create(['name' => 'Paciente']);

        User::find(1)->assignRole('Administrador');

    }
}
