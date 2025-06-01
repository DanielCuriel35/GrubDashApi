<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->string('nombreLocal');
            $table->string('img');
            $table->string('precioMedio');
            $table->string('descripcion');
            $table->string('localidad');
            $table->string('ubicacion');
            $table->timestamps();

            $table->foreign('usuario_id')
                ->references('id')->on('usuarios')
                ->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('restaurantes');
    }
};
