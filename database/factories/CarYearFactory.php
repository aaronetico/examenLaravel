<?php

namespace Database\Factories;

use App\Models\CarYear;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarYearFactory extends Factory
{
    protected $model = CarYear::class;

    public function definition(): array
    {
        return [
            'car_model_id' => CarModel::factory(),
            'year' => $this->faker->numberBetween(1970, 2025),
        ];
    }
}
