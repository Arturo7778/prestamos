<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([

            /*
            |--------------------------------------------------------------------------
            | Middleware de administración
            |--------------------------------------------------------------------------
            */

            'admin' => \App\Http\Middleware\AdminMiddleware::class,


            /*
            |--------------------------------------------------------------------------
            | Middleware de roles
            |--------------------------------------------------------------------------
            */

            'role' => \App\Http\Middleware\RoleMiddleware::class,


            /*
            |--------------------------------------------------------------------------
            | Middleware de permisos
            |--------------------------------------------------------------------------
            */

            'permission' => \App\Http\Middleware\PermissionMiddleware::class,

        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();