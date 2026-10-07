<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [
            [
                'nombre' => 'dashboard.ver',
                'descripcion' => 'Ver el dashboard principal',
                'modulo' => 'Dashboard',
            ],

            [
                'nombre' => 'clientes.ver',
                'descripcion' => 'Ver clientes',
                'modulo' => 'Clientes',
            ],
            [
                'nombre' => 'clientes.crear',
                'descripcion' => 'Crear clientes',
                'modulo' => 'Clientes',
            ],
            [
                'nombre' => 'clientes.editar',
                'descripcion' => 'Editar clientes',
                'modulo' => 'Clientes',
            ],
            [
                'nombre' => 'clientes.eliminar',
                'descripcion' => 'Eliminar clientes',
                'modulo' => 'Clientes',
            ],

            [
                'nombre' => 'prestamos.ver',
                'descripcion' => 'Ver préstamos',
                'modulo' => 'Préstamos',
            ],
            [
                'nombre' => 'prestamos.crear',
                'descripcion' => 'Crear préstamos',
                'modulo' => 'Préstamos',
            ],
            [
                'nombre' => 'prestamos.editar',
                'descripcion' => 'Editar préstamos',
                'modulo' => 'Préstamos',
            ],
            [
                'nombre' => 'prestamos.eliminar',
                'descripcion' => 'Eliminar préstamos',
                'modulo' => 'Préstamos',
            ],

            [
                'nombre' => 'cuotas.ver',
                'descripcion' => 'Ver cuotas',
                'modulo' => 'Cuotas',
            ],
            [
                'nombre' => 'cuotas.editar',
                'descripcion' => 'Editar cuotas',
                'modulo' => 'Cuotas',
            ],
            [
                'nombre' => 'cuotas.pagar',
                'descripcion' => 'Registrar el pago de una cuota',
                'modulo' => 'Cuotas',
            ],

            [
                'nombre' => 'pagos.ver',
                'descripcion' => 'Ver pagos registrados',
                'modulo' => 'Pagos',
            ],
            [
                'nombre' => 'pagos.registrar',
                'descripcion' => 'Registrar pagos',
                'modulo' => 'Pagos',
            ],
            [
                'nombre' => 'pagos.editar',
                'descripcion' => 'Editar pagos',
                'modulo' => 'Pagos',
            ],
            [
                'nombre' => 'pagos.eliminar',
                'descripcion' => 'Eliminar pagos',
                'modulo' => 'Pagos',
            ],

            [
                'nombre' => 'usuarios.ver',
                'descripcion' => 'Ver usuarios',
                'modulo' => 'Usuarios',
            ],
            [
                'nombre' => 'usuarios.crear',
                'descripcion' => 'Crear usuarios',
                'modulo' => 'Usuarios',
            ],
            [
                'nombre' => 'usuarios.editar',
                'descripcion' => 'Editar usuarios',
                'modulo' => 'Usuarios',
            ],
            [
                'nombre' => 'usuarios.eliminar',
                'descripcion' => 'Eliminar usuarios',
                'modulo' => 'Usuarios',
            ],

            [
                'nombre' => 'configuracion.ver',
                'descripcion' => 'Ver la configuración del sistema',
                'modulo' => 'Configuración',
            ],
        ];

        foreach ($permisos as $permiso) {
            Permission::updateOrCreate(
                ['nombre' => $permiso['nombre']],
                [
                    'descripcion' => $permiso['descripcion'],
                    'modulo' => $permiso['modulo'],
                ]
            );
        }
    }
}