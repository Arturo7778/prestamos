<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Mostrar historial de pagos.
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $pagos = Pago::with([
            'cuota.prestamo.cliente',
        ])
            ->when($buscar, function ($query, $buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->whereHas(
                        'cuota.prestamo.cliente',
                        function ($clienteQuery) use ($buscar) {
                            $clienteQuery
                                ->where(
                                    'nombre',
                                    'like',
                                    "%{$buscar}%"
                                )
                                ->orWhere(
                                    'dni',
                                    'like',
                                    "%{$buscar}%"
                                );
                        }
                    )
                    ->orWhereHas(
                        'cuota.prestamo',
                        function ($prestamoQuery) use ($buscar) {
                            $prestamoQuery->where(
                                'id',
                                $buscar
                            );
                        }
                    )
                    ->orWhereHas(
                        'cuota',
                        function ($cuotaQuery) use ($buscar) {
                            $cuotaQuery->where(
                                'numero',
                                $buscar
                            );
                        }
                    )
                    ->orWhere(
                        'metodo_pago',
                        'like',
                        "%{$buscar}%"
                    );
                });
            })
            ->latest('fecha_pago')
            ->latest('id')
            ->get();

        return view('pagos.index', [
            'pagos' => $pagos,
            'buscar' => $buscar,
        ]);
    }
}