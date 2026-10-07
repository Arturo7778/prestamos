<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prestamo extends Model
{
    protected $fillable = [
        'cliente_id',
        'monto',
        'tasa_interes',
        'tasa_mora_diaria',
        'numero_cuotas',
        'frecuencia',
        'fecha_inicio',
        'estado',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'tasa_interes' => 'decimal:2',
        'tasa_mora_diaria' => 'decimal:2',
        'fecha_inicio' => 'date',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function cuotas(): HasMany
    {
        return $this->hasMany(Cuota::class);
    }
}