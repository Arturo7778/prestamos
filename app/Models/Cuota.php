<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cuota extends Model
{
    protected $fillable = [
        'prestamo_id',
        'numero',
        'monto',
        'capital',
        'interes',
        'monto_pagado',
        'mora',
        'fecha_vencimiento',
        'estado',
        'fecha_pago',
        'metodo_pago',
        'referencia_pago',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'capital' => 'decimal:2',
        'interes' => 'decimal:2',
        'monto_pagado' => 'decimal:2',
        'mora' => 'decimal:2',
        'fecha_vencimiento' => 'date',
        'fecha_pago' => 'date',
    ];

    public function prestamo(): BelongsTo
    {
        return $this->belongsTo(Prestamo::class);
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }
}