<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CarModel;
use App\Models\CarYear;

class CarYearSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('data/car_years.csv');

        if (!file_exists($file)) {
            $this->command->info("El archivo car_years.csv no existe.");
            return;
        }

        //Esto lee el CSV y parsea cada línea
        $lines = array_map('str_getcsv', file($file));

        //Prepara los datos por ej quita las cabeceras etc.
        $header = array_shift($lines);

        foreach ($lines as $row) {
            // Columnas del CSV
            $modelName = trim($row[0]);
            $year = (int) trim($row[1]); // clave: convertir a entero

            // Buscar el modelo en la base de datos todo esto es para que coincida con los demás csvs
            $carModel = CarModel::where('name', $modelName)->first();

            if (!$carModel) {
                $this->command->warn("No se encontró el modelo: {$modelName}, saltando...");
                continue;
            }

            // Insertar o actualizar el año
            CarYear::updateOrInsert(
                [
                    'car_model_id' => $carModel->id,
                    'year' => $year,
                ],
                [] // No hay columnas extra que actualizar
            );
        }

    }
}
