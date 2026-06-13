<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_reserva_wellness', function (Blueprint $table) {
            // Las dos llaves foráneas que conectan las tablas
            $table->foreignId('id_reserva_fk')->constrained('reservas', 'id_reserva')->onDelete('cascade');
            $table->foreignId('id_servicio_fk')->constrained('servicio_wellness', 'id_servicio')->onDelete('cascade');

            $table->integer('cantidad')->default(1);

            $table->primary(['id_reserva_fk', 'id_servicio_fk']); // Llave primaria compuesta

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_reserva_wellness');
    }
};
