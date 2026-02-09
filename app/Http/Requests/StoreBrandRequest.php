<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('gestionar brands') ?? false;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:brands,name',
        ];
    }
}
