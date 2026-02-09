<?php

namespace Database\Factories;

use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Part;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition(): array
    {
        return [
            'cart_id' => Cart::factory(),
            'part_id' => Part::inRandomOrder()->first()->id ?? null,
            'quantity' => $this->faker->numberBetween(1, 5),
            'price_at_time' => function (array $attributes) {
                $part = Part::find($attributes['part_id']);
                return $part ? $part->price : 100.00;
            },
        ];
    }
}
