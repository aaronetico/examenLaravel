<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    // Columnas que se pueden asignar masivamente
    protected $fillable = [
        'user_id',
        'status',
    ];

    /**
     * Relación: un carrito tiene muchos items
     */
    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
