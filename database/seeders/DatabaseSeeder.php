<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            BrandSeeder::class,
            CarModelSeeder::class,
            CarYearSeeder::class,
            CarVersionSeeder::class,
            FakeDataSeeder::class,
            CartSeeder::class,
        ]);
    }
}
