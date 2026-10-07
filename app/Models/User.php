<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function permisos(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'user_permissions'
        )->withTimestamps();
    }

    public function esAdministrador(): bool
    {
        return $this->role === 'administrador';
    }

    public function esCobrador(): bool
    {
        return $this->role === 'cobrador';
    }

    public function esConsulta(): bool
    {
        return $this->role === 'consulta';
    }

    public function tienePermiso(string $permiso): bool
    {
        if ($this->esAdministrador()) {
            return true;
        }

        $this->loadMissing('permisos');

        return $this->permisos->contains('nombre', $permiso);
    }
}