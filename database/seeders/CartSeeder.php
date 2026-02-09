<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        // Para cada usuario cliente, creamos un carrito con 2-4 items
        User::role('cliente')->get()->each(function ($user) {
            $cart = Cart::firstOrCreate([
                'user_id' => $user->id,
                'status' => 'active'
            ]);

            // Añadir entre 2 y 4 items
            $itemsCount = rand(2, 4);
            CartItem::factory()->count($itemsCount)->create([
                'cart_id' => $cart->id
            ]);
        });
    }
}
