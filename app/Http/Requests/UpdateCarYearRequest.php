<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('gestionar car years') ?? false;
    }

    public function rules(): array
    {
        return [
            'car_model_id' => 'required|exists:car_models,id',
            'year' => 'required|integer',
        ];
    }
}
