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
        $imagePool = [
            'https://upload.wikimedia.org/wikipedia/commons/0/0e/Disc_brake.jpg',
            'https://upload.wikimedia.org/wikipedia/commons/8/8c/Engine_oil_filter.JPG',
            'https://upload.wikimedia.org/wikipedia/commons/5/5d/Shock_absorber.jpg',
            'https://upload.wikimedia.org/wikipedia/commons/1/1f/Tie_rod_end.jpg',
            'https://upload.wikimedia.org/wikipedia/commons/7/73/Timing_belt.jpg',
        ];

        return [
            'car_version_id' => null, // la versión real
            'name' => $this->faker->word() . ' ' . $this->faker->randomElement(['kit','assembly','unit','set']),
            'sku' => strtoupper($this->faker->bothify('???-#####')),
            'description' => $this->faker->sentence(),
            'image_url' => $this->faker->randomElement($imagePool),
            'price' => $this->faker->randomFloat(2, 10, 800),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
