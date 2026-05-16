<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Part extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['car_version_id', 'name', 'sku', 'description', 'image_url', 'price', 'stock', 'agotado'];

    //Viene de versiones
    public function carVersion(): BelongsTo
    {
        return $this->belongsTo(CarVersion::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

}
