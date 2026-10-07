<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cuotas', function (Blueprint $table) {
            $table->decimal('capital', 12, 2)
                ->default(0)
                ->after('monto');

            $table->decimal('interes', 12, 2)
                ->default(0)
                ->after('capital');
        });
    }

    public function down(): void
    {
        Schema::table('cuotas', function (Blueprint $table) {
            $table->dropColumn([
                'capital',
                'interes',
            ]);
        });
    }
};
