<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; //Prepara ya los getters y setters por debajo.
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
