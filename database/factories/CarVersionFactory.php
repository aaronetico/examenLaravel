<?php

namespace Database\Factories;

use App\Models\CarVersion;
use App\Models\CarYear;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarVersionFactory extends Factory
{
    protected $model = CarVersion::class;

    public function definition(): array
    {
        return [
            'car_year_id' => null,
            'name' => 'DX', // valor por defecto, luego se sobreescribe
        ];
    }
}
