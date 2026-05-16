<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('editar parts') ?? false;
    }

    public function rules(): array
    {
        return [
            'car_version_id' => 'required|exists:car_versions,id',
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:255|unique:parts,sku,' . $this->part->id,
            'description' => 'nullable|string',
            'image_url' => 'nullable|url|max:500',
            'price' => 'nullable|numeric',
            'stock' => 'nullable|integer',
            'agotado' => 'nullable|boolean',
        ];
    }
}
