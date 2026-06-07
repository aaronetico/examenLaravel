<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    // Lista todas las marcas de coches
    public function index()
    {
        return response()->json(Brand::orderBy('id')->get());
    }

    // Guarda una marca nueva en la base de datos
    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create($request->validated());
        return response()->json($brand, 201);
    }

    public function show(Brand $brand)
    {
        return response()->json($brand);
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());
        return response()->json($brand);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json(null, 204);
    }

    // Obtener todos los modelos de una marca
    public function models($brandId)
    {
        $brand = Brand::findOrFail($brandId);
        return response()->json($brand->models()->orderBy('id')->get());
    }

}
