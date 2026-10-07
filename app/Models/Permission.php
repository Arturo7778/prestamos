<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'modulo',
    ];

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_permissions'
        )->withTimestamps();
    }
}