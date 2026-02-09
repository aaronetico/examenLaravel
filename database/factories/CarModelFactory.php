<?php

namespace Database\Factories;

use App\Models\CarModel;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarModelFactory extends Factory
{
    protected $model = CarModel::class;

    public function definition(): array
    {
        return [
            'brand_id' => Brand::factory(),
            'name' => $this->faker->unique()->word(),
        ];
    }
}
