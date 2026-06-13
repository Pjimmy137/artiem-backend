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
        Schema::create('hoteles', function (Blueprint $table) {
            $table->id('id_hotel');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('ciudad');
            $table->json('galeria_fotos')->nullable(); // Guardaremos las URLs de las fotos
            $table->string('mapa_coordenadas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoteles');
    }
};
