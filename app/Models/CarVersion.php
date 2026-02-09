<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CarVersion extends Model
{
    use HasFactory;


    protected $fillable = ['car_year_id', 'name'];
    public $timestamps = false;

    public function carYear(): BelongsTo
    {
        return $this->belongsTo(CarYear::class);
    }


    public function parts(): HasMany
    {
        return $this->hasMany(Part::class);
    }
}
