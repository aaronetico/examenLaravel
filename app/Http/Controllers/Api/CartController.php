<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getUserCart(): Cart
    {
        return Cart::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'active',
            ]
        );
    }

    public function index()
    {
        $cart = $this->getUserCart()->load(['items.part']);

        return response()->json($cart);
    }

    public function add(Request $request, Part $part)
    {
        $cart = $this->getUserCart();

        $item = CartItem::where('cart_id', $cart->id)
            ->where('part_id', $part->id)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'cart_id'      => $cart->id,
                'part_id'      => $part->id,
                'quantity'     => 1,
                'price_at_time'=> $part->price,
            ]);
        }

        return response()->json([
            'message' => 'Producto añadido al carrito'
        ]);
    }

    public function remove(Part $part)
    {
        $cart = $this->getUserCart();

        CartItem::where('cart_id', $cart->id)
            ->where('part_id', $part->id)
            ->delete();

        return response()->json([
            'message' => 'Producto eliminado del carrito'
        ]);
    }
}
