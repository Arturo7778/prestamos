<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Verificar que el usuario tenga el permiso solicitado.
     */
    public function handle(
        Request $request,
        Closure $next,
        ...$permisos
    ): Response {

        /*
        |--------------------------------------------------------------------------
        | Verificar autenticación
        |--------------------------------------------------------------------------
        */

        if (!$request->user()) {
            abort(403, 'No estás autenticado.');
        }


        /*
        |--------------------------------------------------------------------------
        | Administrador
        |--------------------------------------------------------------------------
        |
        | El administrador tiene acceso completo al sistema.
        |
        */

        if ($request->user()->esAdministrador()) {
            return $next($request);
        }


        /*
        |--------------------------------------------------------------------------
        | Verificar permisos
        |--------------------------------------------------------------------------
        |
        | Se permite el acceso si el usuario posee al menos uno de los
        | permisos indicados en la ruta.
        |
        */

        foreach ($permisos as $permiso) {

            if ($request->user()->tienePermiso($permiso)) {
                return $next($request);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Sin autorización
        |--------------------------------------------------------------------------
        */

        abort(
            403,
            'No tienes permisos para realizar esta acción.'
        );
    }
}