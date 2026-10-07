<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Verificar que el usuario tenga uno de los roles permitidos.
     */
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response {

        // El usuario debe estar autenticado
        if (!auth()->check()) {
            abort(403, 'No estás autenticado.');
        }

        // Obtener el usuario actual
        $usuario = auth()->user();

        // Verificar si su rol está permitido
        if (!in_array($usuario->role, $roles)) {

            abort(
                403,
                'No tienes permisos para realizar esta acción.'
            );
        }

        return $next($request);
    }
}