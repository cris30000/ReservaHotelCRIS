<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('consultas')->group(function () {

    Route::get('/reservas-agencias', [ConsultasController::class, 'reservasAgencias']);

    Route::get('/reservas-particulares', [ConsultasController::class, 'reservasParticulares']);

    Route::get('/hoteles-categorias', [ConsultasController::class, 'hotelesCategorias']);

});

Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);
Route::apiResource('hotels', \App\Http\Controllers\HotelController::class);
Route::apiResource('rooms', \App\Http\Controllers\RoomController::class); 
Route::apiResource('agencies', \App\Http\Controllers\AgencyController::class);
Route::apiResource('individuals', \App\Http\Controllers\IndividualController::class);

Route::get('consultas/reservas-agencias', [\App\Http\Controllers\ConsultasController::class, 'reservasAgencias']);
Route::get('consultas/reservas-particulares', [\App\Http\Controllers\ConsultasController::class, 'reservasParticulares']);
Route::get('consultas/hoteles-categorias', [\App\Http\Controllers\ConsultasController::class, 'hotelesCategorias']);    
