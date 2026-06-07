<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarVersion;
use Illuminate\Http\Request;

class CarVersionController extends Controller
{
    // Devuelve todas las versiones de motor o acabado
    public function index()
    {
        return CarVersion::orderBy('id')->get();
    }

    public function show(CarVersion $version)
    {
        return $version;
    }

    public function byYear($yearId)
    {
        return CarVersion::where('car_year_id', $yearId)->orderBy('id')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_year_id' => 'required|exists:car_years,id',
            'name' => 'required|string|max:255',
        ]);

        $version = CarVersion::firstOrCreate(
            ['car_year_id' => $request->car_year_id, 'name' => $request->name]
        );

        return response()->json($version, 201);
    }

    public function update(Request $request, CarVersion $version)
    {
        $request->validate([
            'car_year_id' => 'required|exists:car_years,id',
            'name' => 'required|string|max:255',
        ]);

        $version->update([
            'car_year_id' => $request->car_year_id,
            'name' => $request->name,
        ]);

        return response()->json($version);
    }

    public function destroy(CarVersion $version)
    {
        $version->delete();
        return response()->json(null, 204);
    }
}
