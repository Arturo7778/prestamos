<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cuotas', function (Blueprint $table) {

            $table->decimal('monto_pagado', 10, 2)
                ->default(0)
                ->after('monto');

            $table->date('fecha_pago')
                ->nullable()
                ->after('fecha_vencimiento');

            $table->string('metodo_pago')
                ->nullable()
                ->after('fecha_pago');
        });
    }

    public function down(): void
    {
        Schema::table('cuotas', function (Blueprint $table) {

            $table->dropColumn([
                'monto_pagado',
                'fecha_pago',
                'metodo_pago',
            ]);

        });
    }
};
