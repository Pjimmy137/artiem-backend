<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = 'habitaciones';
    protected $primaryKey = 'id_habitacion';
    protected $fillable = ['id_hotel_fk', 'numero', 'tipo_habitacion', 'precio_noche', 'disponibilidad'];
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel_fk', 'id_hotel');
    }
    public function reservas()
    {
        return $this->belongsToMany(Reserva::class, 'detalle_reserva_habitacion', 'id_habitacion_fk', 'id_reserva_fk')
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}
