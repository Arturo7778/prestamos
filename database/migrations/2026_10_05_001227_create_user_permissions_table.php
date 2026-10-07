<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crear relación entre usuarios y permisos.
     */
    public function up(): void
    {
        Schema::create('user_permissions', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Usuario
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Permiso
            |--------------------------------------------------------------------------
            */

            $table->foreignId('permission_id')
                ->constrained('permissions')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Evitar permisos duplicados
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'user_id',
                'permission_id',
            ]);


            $table->timestamps();
        });
    }


    /**
     * Eliminar tabla.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_permissions');
    }
};