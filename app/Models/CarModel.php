<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class CarModel extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['brand_id', 'name'];


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }


    public function years()
    {
        return $this->hasMany(CarYear::class);
    }
}
