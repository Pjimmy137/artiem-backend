<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ServicioWellnessController;
use App\Http\Controllers\TestimonioController;

Route::post('/hoteles/reservas', [ReservaController::class, 'crearReservaCompleta']);
Route::get('/hoteles/servicios-wellness', [ReservaController::class, 'obtenerServiciosWellness']);

Route::apiResource('hoteles', HotelController::class);
Route::apiResource('clientes', ClienteController::class);
Route::apiResource('reservas', ReservaController::class);
Route::apiResource('habitaciones', HabitacionController::class);
Route::apiResource('servicios-wellness', ServicioWellnessController::class);
Route::apiResource('testimonios', TestimonioController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
