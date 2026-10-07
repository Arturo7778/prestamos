<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cuota;
use App\Models\Pago;
use App\Models\Prestamo;

class DashboardController extends Controller
{
    /**
     * Mostrar el dashboard principal.
     */
    public function index()
    {
        $totalClientes = Cliente::count();

        $prestamosActivos = Prestamo::where(
            'estado',
            '!=',
            'pagado'
        )->count();

        $totalPagos = Pago::count();

        $cuotasVencidas = Cuota::whereDate(
            'fecha_vencimiento',
            '<',
            today()
        )
            ->where('estado', '!=', 'pagado')
            ->count();

        $totalPrestado = Prestamo::sum('monto');

        $totalCobrado = Pago::sum('monto');

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

        $proximosVencimientos = Cuota::with([
            'prestamo.cliente',
        ])
            ->where('estado', '!=', 'pagado')
            ->whereDate(
                'fecha_vencimiento',
                '>=',
                today()
            )
            ->orderBy('fecha_vencimiento')
            ->limit(5)
            ->get();

        $ultimosPagos = Pago::with([
            'cuota.prestamo.cliente',
        ])
            ->orderByDesc('fecha_pago')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalClientes',
            'prestamosActivos',
            'totalPagos',
            'cuotasVencidas',
            'totalPrestado',
            'totalCobrado',
            'saldoPendiente',
            'proximosVencimientos',
            'ultimosPagos'
        ));
    }
}