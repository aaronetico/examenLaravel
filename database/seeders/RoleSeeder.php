<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $empleado = Role::firstOrCreate(['name' => 'empleado']);
        $cliente = Role::firstOrCreate(['name' => 'cliente']);

        // ADMIN → TODO
        $admin->givePermissionTo(Permission::all());

        // EMPLEADO → SOLO PARTS
        $empleado->givePermissionTo([
            'crear parts',
            'editar parts',
            'borrar parts'
        ]);

        // CLIENTE → sin permisos especiales (solo ver público)
    }
}
