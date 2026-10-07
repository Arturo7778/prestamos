<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Mostrar los permisos de un usuario.
     */
    public function edit(User $usuario)
    {
        $permisos = Permission::orderBy('modulo')
            ->orderBy('descripcion')
            ->get()
            ->groupBy('modulo');

        $permisosUsuario = $usuario->permisos()
            ->pluck('permissions.id')
            ->toArray();

        return view('permisos.edit', [
            'usuario' => $usuario,
            'permisos' => $permisos,
            'permisosUsuario' => $permisosUsuario,
        ]);
    }

    /**
     * Actualizar los permisos de un usuario.
     */
    public function update(
        Request $request,
        User $usuario
    ) {
        $datos = $request->validate([
            'permisos' => [
                'nullable',
                'array',
            ],

            'permisos.*' => [
                'integer',
                'exists:permissions,id',
            ],
        ]);

        $usuario->permisos()->sync(
            $datos['permisos'] ?? []
        );

        return redirect()
            ->route('usuarios.index')
            ->with(
                'success',
                'Permisos actualizados correctamente.'
            );
    }
}