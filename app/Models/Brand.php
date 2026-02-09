<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Brand extends Model
{
    use HasFactory;


    protected $fillable = ['name'];
    public $timestamps = false;
    //Tiene N modelos
    public function models(): HasMany
    {
        return $this->hasMany(CarModel::class);
    }
}
