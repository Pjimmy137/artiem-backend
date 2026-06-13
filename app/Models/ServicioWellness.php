<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioWellness extends Model
{
    protected $table = 'servicio_wellness';
    protected $primaryKey = 'id_servicio';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_extra',
        'foto_url'
    ];

    public function reservas()
    {
        return $this->belongsToMany(Reserva::class, 'detalle_reserva_wellness', 'id_servicio_fk', 'id_reserva_fk')
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}
