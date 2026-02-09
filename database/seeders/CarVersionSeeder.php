<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarYear;
use App\Models\CarVersion;

class CarVersionSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('data/car_versions.csv');

        if (!file_exists($file)) {
            $this->command->info("El archivo car_versions.csv no existe.");
            return;
        }

        $lines = array_map('str_getcsv', file($file));
        $header = array_shift($lines); // quitar cabecera: model,year,version

        foreach ($lines as $row) {
            $modelName = trim($row[0]);
            $yearValue = (int) trim($row[1]); // <-- convertir a entero
            $versionName = trim($row[2]);

            // Buscar CarYear correcto
            $carYear = CarYear::whereHas('carModel', function($q) use ($modelName) {
                $q->where('name', $modelName);
            })->where('year', $yearValue)->first();

            if (!$carYear) {
                $this->command->warn("No se encontró CarYear para: {$modelName} {$yearValue}, saltando...");
                continue;
            }

            // Crear o actualizar la versión
            CarVersion::updateOrInsert(
                [
                    'car_year_id' => $carYear->id,
                    'name' => $versionName,
                ],
                []
            );
        }

        $this->command->info("Seeder de CarVersion completado.");
    }
}
