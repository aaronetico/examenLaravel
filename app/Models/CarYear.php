<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CarYear extends Model
{
    use HasFactory;


    protected $fillable = ['car_model_id', 'year'];

    public $timestamps = false;
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }


    public function versions(): HasMany
    {
        return $this->hasMany(CarVersion::class);
    }
}
