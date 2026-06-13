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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente'); // PK
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefono')->nullable();
            $table->integer('puntos_fidelidad')->default(0);
            $table->date('fecha_suscripcion_newsletter')->nullable();
            $table->timestamps(); // Esto crea las columnas created_at y updated_at automáticamente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
