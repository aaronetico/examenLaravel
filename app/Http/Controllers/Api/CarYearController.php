<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarYear;
use Illuminate\Http\Request;

class CarYearController extends Controller
{
    // Lista todos los años disponibles en el catálogo
    public function index()
    {
        return CarYear::orderBy('id')->get();
    }

    public function show(CarYear $year)
    {
        return $year;
    }

    public function byModel($modelId)
    {
        return CarYear::where('car_model_id', $modelId)->orderBy('id')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_model_id' => 'required|exists:car_models,id',
            'year' => 'required|integer',
        ]);

        $year = CarYear::firstOrCreate(
            ['car_model_id' => $request->car_model_id, 'year' => $request->year]
        );

        return response()->json($year, 201);
    }

    public function update(Request $request, CarYear $year)
    {
        $request->validate([
            'car_model_id' => 'required|exists:car_models,id',
            'year' => 'required|integer',
        ]);

        $year->update([
            'car_model_id' => $request->car_model_id,
            'year' => $request->year,
        ]);

        return response()->json($year);
    }

    public function destroy(CarYear $year)
    {
        $year->delete();
        return response()->json(null, 204);
    }
    // Obtener versiones de un año
    public function versions($yearId)
    {
        $year = CarYear::findOrFail($yearId);
        return response()->json($year->versions()->orderBy('id')->get());
    }

}
