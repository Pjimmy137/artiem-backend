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
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id('id_habitacion');

            $table->foreignId('id_hotel_fk')->constrained('hoteles', 'id_hotel')->onDelete('cascade');

            $table->string('numero');
            $table->string('tipo_habitacion');
            $table->decimal('precio_noche', 8, 2);
            $table->string('estado_disponibilidad')->default('disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};
