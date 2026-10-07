<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cuota;
use App\Models\Pago;
use App\Models\Prestamo;

class ReporteController extends Controller
{
    /**
     * Mostrar los reportes generales del sistema.
     */
    public function index()
    {
        $totalClientes = Cliente::count();

        $totalPrestamos = Prestamo::count();

        $prestamosActivos = Prestamo::where(
            'estado',
            '!=',
            'pagado'
        )->count();

        $prestamosPagados = Prestamo::where(
            'estado',
            'pagado'
        )->count();

        $totalPagos = Pago::count();

        $totalCobrado = Pago::sum('monto');

        $totalPrestado = Prestamo::sum('monto');

        $cuotasVencidas = Cuota::whereDate(
            'fecha_vencimiento',
            '<',
            today()
        )
            ->where('estado', '!=', 'pagado')
            ->count();

        $saldoPendiente = Cuota::where(
            'estado',
            '!=',
            'pagado'
        )
            ->get()
            ->sum(function ($cuota) {
                $monto = (float) $cuota->monto;
                $mora = (float) ($cuota->mora ?? 0);
                $pagado = (float) ($cuota->monto_pagado ?? 0);

                return max(
                    0,
                    ($monto + $mora) - $pagado
                );
            });

        return view('reportes.index', compact(
            'totalClientes',
            'totalPrestamos',
            'prestamosActivos',
            'prestamosPagados',
            'totalPagos',
            'totalCobrado',
            'totalPrestado',
            'cuotasVencidas',
            'saldoPendiente'
        ));
    }
}