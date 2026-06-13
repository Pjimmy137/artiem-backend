<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hoteles';
    protected $primaryKey = 'id_hotel';
    protected $fillable = ['nombre', 'direccion', 'ciudad', 'galeria_fotos'];

    protected $casts = [
        'galeria_fotos' => 'array',
    ];
    public function habitaciones()
    {
        return $this->hasMany(Habitacion::class, 'id_hotel_fk', 'id_hotel');
    }
}
