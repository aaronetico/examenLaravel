<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Part;
use App\Models\CarVersion;
use App\Http\Requests\StorePartRequest;
use App\Http\Requests\UpdatePartRequest;

class PartController extends Controller
{
    public function index()
    {
        return response()->json(Part::all());
    }

    public function store(StorePartRequest $request)
    {
        $part = Part::create($request->validated());
        return response()->json($part, 201);
    }

    public function show(Part $part)
    {
        return response()->json($part);
    }

    public function update(UpdatePartRequest $request, Part $part)
    {
        $part->update($request->validated());
        return response()->json($part);
    }

    public function destroy(Part $part)
    {
        $part->delete();
        return response()->json(null, 204);
    }

    //Obtener todas las piezas de una versión específica
    public function versions($versionId)
    {
        $version = CarVersion::findOrFail($versionId);
        return response()->json($version->parts);
    }
}
