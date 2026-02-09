<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('data/japanese_brands.csv');

        if (!file_exists($file)) {
            return;
        }

        $lines = array_map('trim', file($file));//Transformar el csv en algo legible
        array_shift($lines); // quitar cabecera "name"

        foreach ($lines as $line) {
            DB::table('brands')->updateOrInsert(
                ['name' => $line]
            );
        }
    }
}
