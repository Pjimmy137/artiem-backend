<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';
    protected $primaryKey = 'id_reserva';
    protected $fillable = [
        'id_cliente_fk',
        'fecha_checkin',
        'fecha_checkout',
        'estado',
        'precio_total'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente_fk', 'id_cliente');
    }
    public function habitaciones()
    {
        return $this->belongsToMany(Habitacion::class, 'detalle_reserva_habitacion', 'id_reserva_fk', 'id_habitacion_fk')
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}
