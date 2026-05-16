<?php

use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CarModelController;
use App\Http\Controllers\Api\CarYearController;
use App\Http\Controllers\Api\CarVersionController;
use App\Http\Controllers\Api\PartController;


//AUTH


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('brands', BrandController::class);
});


//PUBLIC READ



Route::get('brands', [BrandController::class, 'index']);
Route::get('brands/{brand}', [BrandController::class, 'show']);

Route::get('models', [CarModelController::class, 'index']);
Route::get('models/{model}', [CarModelController::class, 'show']);

Route::get('years', [CarYearController::class, 'index']);
Route::get('years/{year}', [CarYearController::class, 'show']);

Route::get('versions', [CarVersionController::class, 'index']);
Route::get('versions/{version}', [CarVersionController::class, 'show']);

Route::get('parts', [PartController::class, 'index']);
Route::get('parts/{part}', [PartController::class, 'show']);

// RELACIONES
//Obtener los modelos de 1 marca
Route::get('brands/{brand}/models', [BrandController::class, 'models']);
//Obtener los años de un 1 modelo
Route::get('models/{model}/years', [CarModelController::class, 'years']);
// Obtener las versiones de 1 año
Route::get('years/{year}/versions', [CarYearController::class, 'versions']);
// Obtener piezas de una versión
Route::get('versions/{version}/parts', [PartController::class, 'versions']);

 //PROTECTED


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/me', [AuthController::class, 'updateMe']);

    //BRANDS
    Route::post('brands', [BrandController::class, 'store'])->middleware('can:gestionar brands');
    Route::put('brands/{brand}', [BrandController::class, 'update'])->middleware('can:gestionar brands');
    Route::delete('brands/{brand}', [BrandController::class, 'destroy'])->middleware('can:gestionar brands');

    //MODELS
    Route::post('models', [CarModelController::class, 'store'])->middleware('can:gestionar models');
    Route::put('models/{model}', [CarModelController::class, 'update'])->middleware('can:gestionar models');
    Route::delete('models/{model}', [CarModelController::class, 'destroy'])->middleware('can:gestionar models');

    //YEARS
    Route::post('years', [CarYearController::class, 'store'])->middleware('can:gestionar car years');
    Route::put('years/{year}', [CarYearController::class, 'update'])->middleware('can:gestionar car years');
    Route::delete('years/{year}', [CarYearController::class, 'destroy'])->middleware('can:gestionar car years');

    //VERSIONS
    Route::post('versions', [CarVersionController::class, 'store'])->middleware('can:gestionar versions');
    Route::put('versions/{version}', [CarVersionController::class, 'update'])->middleware('can:gestionar versions');
    Route::delete('versions/{version}', [CarVersionController::class, 'destroy'])->middleware('can:gestionar versions');

    //PARTS
    Route::post('parts', [PartController::class, 'store'])->middleware('can:crear parts');
    Route::put('parts/{part}', [PartController::class, 'update'])->middleware('can:editar parts');
    Route::delete('parts/{part}', [PartController::class, 'destroy'])->middleware('can:borrar parts');

    //Cart
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add/{part}', [CartController::class, 'add']);
    Route::delete('/cart/remove/{part}', [CartController::class, 'remove']);
});
