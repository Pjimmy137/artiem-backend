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


use App\Models\Hotel;

Route::get('/seed-pro', function () {
    try {
        // Creamos el primer hotel usando tu modelo real de Laravel
        Hotel::create([
            'nombre' => 'ARTIEM Audax',
            'direccion' => 'Av. de la Platja, s/n',
            'ciudad' => 'Menorca',
            'galeria_fotos' => '["https://images.unsplash.com/photo-1582719508461-905c673771fd", "https://images.unsplash.com/photo-1584132967334-10e028bd69f7", "https://images.unsplash.com/photo-1520250497591-112f2f40a3f4", "https://images.unsplash.com/photo-1566073771259-6a8506099945"]'
        ]);

        return "¡Primer hotel de ARTIEM creado con éxito en la base de datos de producción!";
    } catch (\Exception $e) {
        return "Error al guardar en PostgreSQL: " . $e->getMessage();
    }
});
