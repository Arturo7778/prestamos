<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    protected $fillable = [
        'cuota_id',
        'monto',
        'fecha_pago',
        'metodo_pago',
        'referencia_pago',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'fecha_pago' => 'date',
    ];

    public function cuota(): BelongsTo
    {
        return $this->belongsTo(Cuota::class);
    }
}