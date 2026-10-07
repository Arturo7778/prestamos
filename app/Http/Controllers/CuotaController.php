<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuotaController extends Controller
{
    /**
     * Registrar un pago de una cuota.
     */
    public function pagar(Request $request, $id)
    {
        $cuota = Cuota::with('prestamo')->findOrFail($id);

        if ($cuota->estado === 'pagado') {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Esta cuota ya se encuentra completamente pagada.'
                );
        }

        $datos = $request->validate([
            'monto_pagado' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'fecha_pago' => [
                'required',
                'date',
            ],

            'metodo_pago' => [
                'required',
                'in:efectivo,yape,plin,transferencia',
            ],

            'referencia_pago' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $montoCuota = round(
            (float) $cuota->monto,
            2
        );

        $montoYaPagado = round(
            (float) ($cuota->monto_pagado ?? 0),
            2
        );

        $nuevoPago = round(
            (float) $datos['monto_pagado'],
            2
        );

        /*
         * Calcular mora sobre el saldo pendiente
         * de la cuota.
         */
        $mora = 0;

        $fechaVencimiento = $cuota->fecha_vencimiento;

        if (
            $fechaVencimiento &&
            $fechaVencimiento->startOfDay()->isPast()
        ) {
            $diasAtraso = $fechaVencimiento
                ->startOfDay()
                ->diffInDays(now()->startOfDay());

            $tasaMora = round(
                (float) $cuota->prestamo->tasa_mora_diaria,
                4
            );

            $saldoCuota = max(
                0,
                $montoCuota - $montoYaPagado
            );

            $mora = round(
                $saldoCuota
                * ($tasaMora / 100)
                * $diasAtraso,
                2
            );
        }

        $totalConMora = round(
            $montoCuota + $mora,
            2
        );

        $saldoPendiente = max(
            0,
            round(
                $totalConMora - $montoYaPagado,
                2
            )
        );

        if ($nuevoPago > $saldoPendiente) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'El pago supera el saldo pendiente de la cuota. '
                    . 'Saldo actual: S/ '
                    . number_format($saldoPendiente, 2)
                );
        }

        $nuevoTotalPagado = round(
            $montoYaPagado + $nuevoPago,
            2
        );

        $nuevoEstado = $nuevoTotalPagado >= $totalConMora
            ? 'pagado'
            : 'parcial';

        DB::transaction(function () use (
            $cuota,
            $datos,
            $mora,
            $nuevoTotalPagado,
            $nuevoEstado,
            $nuevoPago
        ) {
            /*
             * Guardar el pago en el historial.
             */
            Pago::create([
                'cuota_id' => $cuota->id,
                'monto' => $nuevoPago,
                'fecha_pago' => $datos['fecha_pago'],
                'metodo_pago' => $datos['metodo_pago'],
                'referencia_pago' =>
                    $datos['referencia_pago'] ?? null,
            ]);

            /*
             * Actualizar la cuota.
             */
            $cuota->update([
                'monto_pagado' => $nuevoTotalPagado,
                'mora' => $mora,
                'fecha_pago' => $datos['fecha_pago'],
                'metodo_pago' => $datos['metodo_pago'],
                'referencia_pago' =>
                    $datos['referencia_pago'] ?? null,
                'estado' => $nuevoEstado,
            ]);

            /*
             * Actualizar el estado general del préstamo.
             */
            $prestamo = $cuota->prestamo;

            $cuotasPendientes = $prestamo
                ->cuotas()
                ->where('estado', '!=', 'pagado')
                ->count();

            $prestamo->update([
                'estado' => $cuotasPendientes === 0
                    ? 'pagado'
                    : 'pendiente',
            ]);
        });

        $mensaje = $nuevoEstado === 'pagado'
            ? 'Cuota pagada completamente.'
            : 'Pago parcial registrado correctamente.';

        return redirect()
            ->back()
            ->with('success', $mensaje);
    }
}