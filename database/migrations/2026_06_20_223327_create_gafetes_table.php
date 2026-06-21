<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gafetes', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula');
            $table->string('telefono');
            $table->string('supervisor');
            $table->string('municipio');
            $table->enum('estado', ['activo', 'bloqueado'])->default('activo');
            $table->dateTime('fecha_expiracion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gafetes');
    }
};