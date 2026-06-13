<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonio extends Model
{
    protected $table = 'testimonio';
    protected $primaryKey = 'id_testimonio';

    protected $fillable = [
        'id_cliente_fk',
        'id_hotel_fk',
        'comentario',
        'puntuacion',
        'fecha',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente_fk', 'id_cliente');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'id_hotel_fk', 'id_hotel');
    }
}
