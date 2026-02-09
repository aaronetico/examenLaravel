<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('data/car_models.csv');

        if (!file_exists($file)) {
            return;
        }

        $lines = array_map('trim', file($file));
        array_shift($lines); // quitar cabecera "brand,model"

        foreach ($lines as $line) {
            [$brandName, $modelName] = explode(',', $line);

            $brand = DB::table('brands')->where('name', $brandName)->first();

            if ($brand) {
                DB::table('car_models')->updateOrInsert(
                    ['brand_id' => $brand->id, 'name' => $modelName]
                );
            }
        }
    }
}
