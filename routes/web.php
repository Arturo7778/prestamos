<?php

use App\Http\Controllers\PagoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ReporteController;


/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Rutas protegidas
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('permission:dashboard.ver')
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PERMISOS DE USUARIOS
    |--------------------------------------------------------------------------
    | Permite al administrador consultar y modificar los permisos
    | individuales de cada usuario.
    */

    Route::get('/usuarios/{usuario}/permisos', [PermisoController::class, 'edit'])
        ->middleware('permission:usuarios.permisos')
        ->name('usuarios.permisos.edit');

    Route::put('/usuarios/{usuario}/permisos', [PermisoController::class, 'update'])
        ->middleware('permission:usuarios.permisos')
        ->name('usuarios.permisos.update');

    /*
    |--------------------------------------------------------------------------
    | Perfil
    |--------------------------------------------------------------------------
    |
    | El perfil pertenece al usuario autenticado y no depende del sistema
    | de permisos administrativos.
    |
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | CLIENTES
    |--------------------------------------------------------------------------
    */


    /*
    | Ver listado de clientes
    */

    Route::get('/clientes', [ClienteController::class, 'index'])
        ->middleware('permission:clientes.ver')
        ->name('clientes.index');


    /*
    | Formulario para crear cliente
    */

    Route::get('/clientes/create', [ClienteController::class, 'create'])
        ->middleware('permission:clientes.crear')
        ->name('clientes.create');


    /*
    | Guardar cliente
    */

    Route::post('/clientes', [ClienteController::class, 'store'])
        ->middleware('permission:clientes.crear')
        ->name('clientes.store');


    /*
    | Mostrar cliente
    */

    Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])
        ->middleware('permission:clientes.ver')
        ->name('clientes.show');


    /*
    | Formulario para editar cliente
    */

    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])
        ->middleware('permission:clientes.editar')
        ->name('clientes.edit');


    /*
    | Actualizar cliente
    */

    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])
        ->middleware('permission:clientes.editar')
        ->name('clientes.update');

    /*
    | Eliminar cliente
    */

    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])
        ->middleware('permission:clientes.eliminar')
        ->name('clientes.destroy');


    /*
    |--------------------------------------------------------------------------
    | PRÉSTAMOS
    |--------------------------------------------------------------------------
    */


    /*
    | Ver listado de préstamos
    */

    Route::get('/prestamos', [PrestamoController::class, 'index'])
        ->middleware('permission:prestamos.ver')
        ->name('prestamos.index');


    /*
    | Formulario para crear préstamo
    */

    Route::get('/prestamos/create', [PrestamoController::class, 'create'])
        ->middleware('permission:prestamos.crear')
        ->name('prestamos.create');


    /*
    | Guardar préstamo
    */

    Route::post('/prestamos', [PrestamoController::class, 'store'])
        ->middleware('permission:prestamos.crear')
        ->name('prestamos.store');


    /*
    | Mostrar préstamo
    */

    Route::get('/prestamos/{prestamo}', [PrestamoController::class, 'show'])
        ->middleware('permission:prestamos.ver')
        ->name('prestamos.show');


    /*
    | Formulario para editar préstamo
    */

    Route::get('/prestamos/{prestamo}/edit', [PrestamoController::class, 'edit'])
        ->middleware('permission:prestamos.editar')
        ->name('prestamos.edit');


    /*
    | Actualizar préstamo
    */

    Route::put('/prestamos/{prestamo}', [PrestamoController::class, 'update'])
        ->middleware('permission:prestamos.editar')
        ->name('prestamos.update');

    /*
    | Eliminar préstamo
    */

    Route::delete('/prestamos/{prestamo}', [PrestamoController::class, 'destroy'])
        ->middleware('permission:prestamos.eliminar')
        ->name('prestamos.destroy');


    /*
    |--------------------------------------------------------------------------
    | PAGOS
    |--------------------------------------------------------------------------
    |
    | Registrar un pago requiere el permiso pagos.registrar.
    |
    */
    Route::get('/pagos', [PagoController::class, 'index'])
        ->middleware('permission:pagos.ver')
        ->name('pagos.index');

    Route::post(
        '/cuotas/{id}/pagar',
        [CuotaController::class, 'pagar']
    )
        ->middleware('permission:pagos.registrar')
        ->name('cuotas.pagar');


    /*
    |--------------------------------------------------------------------------
    | USUARIOS
    |--------------------------------------------------------------------------
    |
    | Ya NO utilizamos solamente "admin".
    |
    | Ahora el acceso depende de permisos individuales.
    |
    */


    /*
    | Ver usuarios
    */

    Route::get('/usuarios', [UsuarioController::class, 'index'])
        ->middleware('permission:usuarios.ver')
        ->name('usuarios.index');


    /*
    | Formulario para crear usuario
    */

    Route::get('/usuarios/create', [UsuarioController::class, 'create'])
        ->middleware('permission:usuarios.crear')
        ->name('usuarios.create');


    /*
    | Guardar usuario
    */

    Route::post('/usuarios', [UsuarioController::class, 'store'])
        ->middleware('permission:usuarios.crear')
        ->name('usuarios.store');


    /*
    | Mostrar usuario
    */

    Route::get('/usuarios/{usuario}', [UsuarioController::class, 'show'])
        ->middleware('permission:usuarios.ver')
        ->name('usuarios.show');


    /*
    | Formulario para editar usuario
    */

    Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])
        ->middleware('permission:usuarios.editar')
        ->name('usuarios.edit');


    /*
    | Actualizar usuario
    */

    Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])
        ->middleware('permission:usuarios.editar')
        ->name('usuarios.update');

    /*
    | Eliminar usuario
    */

    Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])
        ->middleware('permission:usuarios.eliminar')
        ->name('usuarios.destroy');
    /*
    | Reporte
    */
    Route::get('/reportes', [ReporteController::class, 'index'])
        ->middleware('permission:configuracion.ver')
        ->name('reportes.index');

});


/*
|--------------------------------------------------------------------------
| Autenticación Breeze
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';