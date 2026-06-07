<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function index()
    {
        return CarModel::orderBy('id')->get();
    }

    public function show(CarModel $model)
    {
        return $model;
    }

    public function byBrand($brandId)
    {
        return CarModel::where('brand_id', $brandId)->orderBy('id')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
        ]);

        $model = CarModel::firstOrCreate(
            ['brand_id' => $request->brand_id, 'name' => $request->name]
        );

        return response()->json($model, 201);
    }

    public function update(Request $request, CarModel $model)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
        ]);

        $model->update([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
        ]);

        return response()->json($model);
    }

    public function destroy(CarModel $model)
    {
        $model->delete();
        return response()->json(null, 204);
    }
    // Obtener años de un modelo
    public function years($modelId)
    {
        $model = CarModel::findOrFail($modelId);
        return response()->json($model->years()->orderBy('id')->get());
    }

}
