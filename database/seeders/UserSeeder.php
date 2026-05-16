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
                'last_name' => 'Falcar',
                'birth_date' => '1990-01-01',
                'country' => 'España',
                'city' => 'Madrid',
            ]
        );
        $admin->assignRole('admin');

        // Usuario EMPLEADO
        $empleado = User::firstOrCreate(
            ['email' => 'empleado@example.com'],
            [
                'name' => 'Empleado',
                'password' => Hash::make('password123'),
                'last_name' => 'Taller',
                'birth_date' => '1995-05-10',
                'country' => 'España',
                'city' => 'Valencia',
            ]
        );
        $empleado->assignRole('empleado');

        // Usuario CLIENTE
        $cliente = User::firstOrCreate(
            ['email' => 'cliente@example.com'],
            [
                'name' => 'Cliente',
                'password' => Hash::make('password123'),
                'last_name' => 'Demo',
                'birth_date' => '2000-08-20',
                'country' => 'España',
                'city' => 'Sevilla',
            ]
        );
        $cliente->assignRole('cliente');
    }
}
