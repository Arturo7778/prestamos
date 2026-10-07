<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Permitir el acceso únicamente a administradores.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        if (
            !$request->user() ||
            !$request->user()->esAdministrador()
        ) {

            abort(403, 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
