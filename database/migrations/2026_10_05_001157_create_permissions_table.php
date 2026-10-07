<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crear tabla de permisos.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Nombre interno del permiso
            |--------------------------------------------------------------------------
            |
            | Ejemplos:
            |
            | clientes.ver
            | clientes.crear
            | clientes.editar
            | clientes.eliminar
            |
            */

            $table->string('nombre')->unique();


            /*
            |--------------------------------------------------------------------------
            | Nombre visible
            |--------------------------------------------------------------------------
            */

            $table->string('descripcion');


            /*
            |--------------------------------------------------------------------------
            | Módulo al que pertenece
            |--------------------------------------------------------------------------
            */

            $table->string('modulo');


            $table->timestamps();
        });
    }


    /**
     * Eliminar tabla.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};