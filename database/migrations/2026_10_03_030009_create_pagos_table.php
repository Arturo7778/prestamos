<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crear tabla de pagos.
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | CUOTA A LA QUE PERTENECE EL PAGO
            |--------------------------------------------------------------------------
            */

            $table->foreignId('cuota_id')
                ->constrained('cuotas')
                ->onDelete('cascade');


            /*
            |--------------------------------------------------------------------------
            | INFORMACIÓN DEL PAGO
            |--------------------------------------------------------------------------
            */

            $table->decimal('monto', 10, 2);

            $table->date('fecha_pago');

            $table->enum('metodo_pago', [
                'efectivo',
                'yape',
                'plin',
                'transferencia'
            ]);

            $table->string('referencia_pago')
                ->nullable();


            $table->timestamps();
        });
    }

    /**
     * Eliminar tabla de pagos.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};