<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarVersionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('gestionar versions') ?? false;
    }

    public function rules(): array
    {
        return [
            'car_year_id' => 'required|exists:car_years,id',
            'name' => 'required|string|max:255',
        ];
    }
}
