<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmacionReserva;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Habitacion;
use Illuminate\Support\Facades\DB;
use App\Models\ServicioWellness;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Reserva::with('cliente')->get());
    }

    public function crearReservaCompleta(Request $request)
    {
        // 1. Validamos los datos entrantes (Cambiado a 'hotel_id' que es lo que manda Angular)
        $request->validate([
            'hotel_id' => 'required|integer',
            'hotel_nombre' => 'nullable|string',
            'tipo_habitacion' => 'required|string',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date',
            'noches' => 'nullable|integer',
            'cliente.email' => 'required|email',
            'cliente.nombre' => 'required|string',
            'monto_total' => 'required',
        ]);

        // Iniciamos la transacción para evitar registros huérfanos si algo falla
        DB::beginTransaction();

        try {
            // 2. Alta o recuperación del Cliente
            $datosCliente = $request->input('cliente');
            $cliente = Cliente::firstOrCreate(
                ['email' => $datosCliente['email']],
                [
                    'nombre' => $datosCliente['nombre'],
                    'apellidos' => $datosCliente['apellidos'],
                    'telefono' => $datosCliente['telefono']
                ]
            );

            $fechaEntrada = $request->input('fecha_entrada');
            $fechaSalida = $request->input('fecha_salida');

            // 3. 🎯 Búsqueda de habitación física libre (Corregidos nombres a id_hotel e id_habitacion)
            $habitacionLibre = Habitacion::where('id_hotel_fk', $request->input('hotel_id'))
                ->where('tipo_habitacion', $request->input('tipo_habitacion'))
                ->whereNotExists(function ($query) use ($fechaEntrada, $fechaSalida) {
                    $query->select(DB::raw(1))
                          ->from('detalle_reserva_habitacion')
                          ->join('reservas', 'detalle_reserva_habitacion.id_reserva_fk', '=', 'reservas.id_reserva')
                          // 🌟 CAMBIADO: 'habitaciones.id' por 'habitaciones.id_habitacion'
                          ->whereColumn('detalle_reserva_habitacion.id_habitacion_fk', 'habitaciones.id_habitacion')
                          ->where(function ($q) use ($fechaEntrada, $fechaSalida) {
                              $q->where('reservas.fecha_checkin', '<', $fechaSalida)
                                ->where('reservas.fecha_checkout', '>', $fechaEntrada);
                          });
                })
                ->first();

            // Si el hotel está lleno para ese tipo de habitación, avisamos a Angular
            if (!$habitacionLibre) {
                return response()->json([
                    'error' => 'No quedan habitaciones físicas disponibles de este tipo para las fechas seleccionadas.'
                ], 422);
            }

            // 4. Guardamos la Reserva usando TUS columnas del modelo $fillable
            $reserva = new Reserva();
            $reserva->id_cliente_fk = $cliente->id_cliente; // Vinculamos con tu clave foránea
            $reserva->fecha_checkin = $fechaEntrada;
            $reserva->fecha_checkout = $fechaSalida;
            $reserva->precio_total = $request->input('monto_total');
            $reserva->estado = 'Confirmada'; // 'Confirmada' con mayúscula tal como figura en tus datos
            $reserva->save();

            // 5. Ocupamos la habitación vinculándola en la relación BelongsToMany
            // 🌟 CAMBIADO: '$habitacionLibre->id' por '$habitacionLibre->id_habitacion'
            $reserva->habitaciones()->attach($habitacionLibre->id_habitacion, ['cantidad' => 1]);

            DB::commit(); // Confirmamos la persistencia en PostgreSQL

            // 1. Extraemos el correo del cliente que viene en la petición del Checkout
            DB::commit(); // Confirmamos la persistencia en PostgreSQL

            // 1. Extraemos el correo del cliente que viene en la petición del Checkout
            $correoCliente = $request->input('cliente.email');

            // 2. Preparamos los datos cruzando las claves EXACTAS que envía tu Frontend
            $datosParaEmail = [
                'hotel_nombre'          => $request->input('hotel_nombre') ?? 'ARTIEM Hotel',
                'tipo_habitacion' => $request->input('tipo_habitacion'),
                'noches'          => $request->input('noches') ?? 1,
                'precio_total'    => $request->input('monto_total'),
            ];

            // 3. Enviamos el correo de verdad a producción
            Mail::to($correoCliente)->send(new ConfirmacionReserva($datosParaEmail));

            return response()->json([
                'success' => true,
                'mensaje' => 'Reserva realizada correctamente',
                'id_reserva' => $reserva->id_reserva
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack(); // Deshacemos todo ante cualquier fallo inesperado
            return response()->json([
                'error' => 'Error interno en el servidor',
                'detalles' => $e->getMessage()
            ], 500);
        }
    }

    public function obtenerServiciosWellness()
    {
        try {
            $servicios = ServicioWellness::all();
            return response()->json($servicios, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudieron cargar los servicios wellness',
                'detalles' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Busca una reserva específica por su ID
        $reserva = Reserva::with(['cliente', 'habitaciones'])->find($id);

        if (!$reserva) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }

        return response()->json($reserva);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
