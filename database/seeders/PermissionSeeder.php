<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permisos = [

            // PARTS (empleado puede trabajar aquí)
            'crear parts',
            'editar parts',
            'borrar parts',

            // ESTRUCTURA (solo admin)
            'gestionar brands',
            'gestionar models',
            'gestionar car years',
            'gestionar versions',

        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }
    }
}
