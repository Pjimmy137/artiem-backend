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
        Schema::create('testimonio', function (Blueprint $table) {
            $table->id('id_testimonio');

            $table->foreignId('id_cliente_fk')->constrained('clientes', 'id_cliente')->onDelete('cascade');
            $table->foreignId('id_hotel_fk')->constrained('hoteles', 'id_hotel')->onDelete('cascade');

            $table->text('comentario');
            $table->integer('puntuacion'); // Por ejemplo del 1 al 5
            $table->date('fecha');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonio');
    }
};
