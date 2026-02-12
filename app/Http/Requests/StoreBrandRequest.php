<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool //Cuando ve que hay un storeBrandRequest , se ejecuta antes por debajo (valida), y si da true, va al controller.
    {
        return $this->user()?->can('gestionar brands') ?? false;
    }


    public function rules(): array
    {
        return [            //Controlar que no haya más con el mismo nombre
            'name' => 'required|string|max:255|unique:brands,name',
        ];
    }
}
