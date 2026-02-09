<?php

namespace Database\Factories;

use App\Models\Part;
use App\Models\CarVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartFactory extends Factory
{
    protected $model = Part::class;

    public function definition(): array
    {
        return [
            'car_version_id' => null, // la versión real
            'name' => $this->faker->word() . ' ' . $this->faker->randomElement(['kit','assembly','unit','set']),
            'sku' => strtoupper($this->faker->bothify('???-#####')),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 800),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
