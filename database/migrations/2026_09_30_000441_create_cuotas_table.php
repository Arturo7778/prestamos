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
        Schema::create('cuotas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('prestamo_id')
                ->constrained('prestamos')
                ->onDelete('cascade');

            $table->integer('numero');

            $table->decimal('monto', 10, 2);

            $table->date('fecha_vencimiento');

            $table->enum('estado', [
                'pendiente',
                'pagada',
                'vencida'
            ])->default('pendiente');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuotas');
    }
};
