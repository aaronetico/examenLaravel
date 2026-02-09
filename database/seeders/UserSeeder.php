<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario ADMIN
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
            ]
        );
        $admin->assignRole('admin');

        // Usuario EMPLEADO
        $empleado = User::firstOrCreate(
            ['email' => 'empleado@example.com'],
            [
                'name' => 'Empleado',
                'password' => Hash::make('password123'),
            ]
        );
        $empleado->assignRole('empleado');

        // Usuario CLIENTE
        $cliente = User::firstOrCreate(
            ['email' => 'cliente@example.com'],
            [
                'name' => 'Cliente',
                'password' => Hash::make('password123'),
            ]
        );
        $cliente->assignRole('cliente');
    }
}
