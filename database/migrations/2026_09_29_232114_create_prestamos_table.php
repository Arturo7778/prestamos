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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->onDelete('restrict');

            $table->decimal('monto', 10, 2);

            $table->decimal('tasa_interes', 5, 2);

            $table->integer('numero_cuotas');

            $table->enum('frecuencia', [
                'diaria',
                'semanal',
                'quincenal',
                'mensual',
            ]);

            $table->date('fecha_inicio');

            $table->enum('estado', [
                'pendiente',
                'activo',
                'pagado',
                'vencido'
            ])->default('pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
