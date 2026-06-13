<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    protected $fillable = ['nombre', 'email', 'apellidos', 'telefono', 'puntos_fidelidad', 'fecha_subcripcion_newsletter'];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_cliente_fk', 'id_cliente');
    }
}
