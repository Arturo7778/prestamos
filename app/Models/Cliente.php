<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $fillable = [
        'dni',
        'nombre',
        'telefono',
        'correo',
        'direccion',
        'fecha_nacimiento',
    ];

    public function prestamos(): HasMany
    {
        return $this->hasMany(Prestamo::class);
    }
}