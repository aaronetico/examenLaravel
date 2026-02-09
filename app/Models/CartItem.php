<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'part_id',
        'quantity',
        'price_at_time',
    ];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
