<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cuota;
use App\Models\Prestamo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    /**
     * Mostrar todos los préstamos.
     */
    public function index()
    {
        $prestamos = Prestamo::with('cliente')->get();

        return view('prestamos.index', [
            'prestamos' => $prestamos,
        ]);
    }

    /**
     * Mostrar formulario para crear un préstamo.
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();

        return view('prestamos.create', [
            'clientes' => $clientes,
        ]);
    }

    /**
     * Mostrar detalle de un préstamo.
     */
    public function show($id)
    {
        $prestamo = Prestamo::with([
            'cliente',
            'cuotas' => function ($query) {
                $query
                    ->with('pagos')
                    ->orderBy('numero');
            },
        ])->findOrFail($id);

        return view('prestamos.show', [
            'prestamo' => $prestamo,
        ]);
    }

    /**
     * Mostrar formulario para editar un préstamo.
     */
    public function edit($id)
    {
        $prestamo = Prestamo::findOrFail($id);

        $clientes = Cliente::orderBy('nombre')->get();

        return view('prestamos.edit', [
            'prestamo' => $prestamo,
            'clientes' => $clientes,
        ]);
    }

    /**
     * Guardar un nuevo préstamo.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'cliente_id' => [
                'required',
                'exists:clientes,id',
            ],

            'monto' => [
                'required',
                'numeric',
                'min:0.01',
                'max:100000',
            ],

            'tasa_interes' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],

            'numero_cuotas' => [
                'required',
                'integer',
                'min:1',
            ],

            'frecuencia' => [
                'required',
                'in:diaria,semanal,quincenal,mensual',
            ],

            'fecha_inicio' => [
                'required',
                'date',
            ],
        ]);

        $monto = (float) $datos['monto'];
        $tasa = (float) $datos['tasa_interes'];
        $numeroCuotas = (int) $datos['numero_cuotas'];

        $interes = round(
            $monto * ($tasa / 100),
            2
        );

        $total = round(
            $monto + $interes,
            2
        );

        $cuotaBase = round(
            $total / $numeroCuotas,
            2
        );

        $prestamo = DB::transaction(function () use (
            $datos,
            $monto,
            $tasa,
            $numeroCuotas,
            $total,
            $cuotaBase
        ) {
            $prestamo = Prestamo::create([
                'cliente_id' => $datos['cliente_id'],
                'monto' => $monto,
                'tasa_interes' => $tasa,
                'numero_cuotas' => $numeroCuotas,
                'frecuencia' => $datos['frecuencia'],
                'fecha_inicio' => $datos['fecha_inicio'],
                'estado' => 'pendiente',
            ]);

            $fechaInicio = Carbon::parse(
                $datos['fecha_inicio']
            );

            for ($i = 1; $i <= $numeroCuotas; $i++) {
                $fecha = $this->calcularFechaCuota(
                    $fechaInicio,
                    $datos['frecuencia'],
                    $i
                );

                $montoCuota = $this->calcularMontoCuota(
                    $total,
                    $cuotaBase,
                    $numeroCuotas,
                    $i
                );

                Cuota::create([
                    'prestamo_id' => $prestamo->id,
                    'numero' => $i,
                    'monto' => $montoCuota,
                    'monto_pagado' => 0,
                    'mora' => 0,
                    'fecha_vencimiento' => $fecha,
                    'estado' => 'pendiente',
                    'fecha_pago' => null,
                    'metodo_pago' => null,
                    'referencia_pago' => null,
                ]);
            }

            return $prestamo;
        });

        return redirect()
            ->route('prestamos.show', $prestamo->id)
            ->with(
                'success',
                'Préstamo registrado correctamente.'
            );
    }

    /**
     * Actualizar un préstamo.
     *
     * Las cuotas pagadas se conservan.
     * Las cuotas pendientes se reconstruyen.
     */
    public function update(Request $request, $id)
    {
        $prestamo = Prestamo::with('cuotas')->findOrFail($id);

        $datos = $request->validate([
            'cliente_id' => [
                'required',
                'exists:clientes,id',
            ],

            'monto' => [
                'required',
                'numeric',
                'min:0.01',
                'max:100000',
            ],

            'tasa_interes' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],

            'numero_cuotas' => [
                'required',
                'integer',
                'min:1',
            ],

            'frecuencia' => [
                'required',
                'in:diaria,semanal,quincenal,mensual',
            ],

            'fecha_inicio' => [
                'required',
                'date',
            ],
        ]);

        $cuotas = $prestamo->cuotas;

        $cuotasPagadas = $cuotas
            ->where('estado', 'pagado');

        $cantidadPagadas = $cuotasPagadas->count();

        /*
         * No se puede establecer una cantidad de cuotas
         * menor a las cuotas que ya fueron pagadas.
         */
        if ((int) $datos['numero_cuotas'] < $cantidadPagadas) {
            return back()
                ->withInput()
                ->withErrors([
                    'numero_cuotas' =>
                        "No puedes establecer {$datos['numero_cuotas']} cuotas porque ya existen {$cantidadPagadas} cuotas pagadas.",
                ]);
        }

        /*
         * Calculamos cuánto del principal ya fue cubierto.
         *
         * La mora no reduce el principal.
         */
        $principalPagado = 0;

        foreach ($cuotasPagadas as $cuota) {
            $montoCuota = (float) $cuota->monto;
            $montoPagado = (float) ($cuota->monto_pagado ?? 0);

            $principalPagado += min(
                $montoPagado,
                $montoCuota
            );
        }

        $principalPagado = round(
            $principalPagado,
            2
        );

        $nuevoMonto = (float) $datos['monto'];
        $nuevaTasa = (float) $datos['tasa_interes'];

        $nuevoInteres = round(
            $nuevoMonto * ($nuevaTasa / 100),
            2
        );

        $nuevoTotal = round(
            $nuevoMonto + $nuevoInteres,
            2
        );

        /*
         * El nuevo préstamo no puede tener un total
         * inferior al principal que ya fue pagado.
         */
        if ($nuevoTotal < $principalPagado) {
            return back()
                ->withInput()
                ->withErrors([
                    'monto' =>
                        'El nuevo total del préstamo no puede ser menor que el monto principal que ya fue pagado.',
                ]);
        }

        $nuevaDeuda = round(
            $nuevoTotal - $principalPagado,
            2
        );

        $numeroCuotasNuevo = (int) $datos['numero_cuotas'];

        $cuotasPendientesNuevas = max(
            0,
            $numeroCuotasNuevo - $cantidadPagadas
        );

        /*
         * Si quedan cuotas pendientes pero la deuda ya es cero,
         * no tiene sentido generar nuevas cuotas.
         */
        if (
            $cuotasPendientesNuevas > 0 &&
            $nuevaDeuda <= 0
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'numero_cuotas' =>
                        'El préstamo ya está completamente cubierto con los pagos realizados.',
                ]);
        }

        DB::transaction(function () use (
            $prestamo,
            $datos,
            $cuotasPagadas,
            $cantidadPagadas,
            $numeroCuotasNuevo,
            $cuotasPendientesNuevas,
            $nuevaDeuda,
            $principalPagado
        ) {
            $prestamo->update([
                'cliente_id' => $datos['cliente_id'],
                'monto' => $datos['monto'],
                'tasa_interes' => $datos['tasa_interes'],
                'numero_cuotas' => $numeroCuotasNuevo,
                'frecuencia' => $datos['frecuencia'],
                'fecha_inicio' => $datos['fecha_inicio'],
            ]);

            /*
             * Las cuotas pagadas permanecen intactas.
             * Solo eliminamos las cuotas que todavía no están pagadas.
             */
            $prestamo->cuotas()
                ->where('estado', '!=', 'pagado')
                ->delete();

            if ($cuotasPendientesNuevas <= 0) {
                $prestamo->update([
                    'estado' => 'pagado',
                ]);

                return;
            }

            $cuotaBase = round(
                $nuevaDeuda / $cuotasPendientesNuevas,
                2
            );

            /*
             * Si ya existen cuotas pagadas, continuamos
             * desde la fecha de vencimiento de la última.
             */
            if ($cantidadPagadas > 0) {
                $ultimaCuotaPagada = $cuotasPagadas
                    ->sortByDesc('numero')
                    ->first();

                $fechaBase = Carbon::parse(
                    $ultimaCuotaPagada->fecha_vencimiento
                );
            } else {
                $fechaBase = Carbon::parse(
                    $datos['fecha_inicio']
                );
            }

            for ($i = 1; $i <= $cuotasPendientesNuevas; $i++) {
                $numeroCuotaReal =
                    $cantidadPagadas + $i;

                $fecha = $this->calcularFechaCuota(
                    $fechaBase,
                    $datos['frecuencia'],
                    $i
                );

                $montoCuota = $this->calcularMontoCuota(
                    $nuevaDeuda,
                    $cuotaBase,
                    $cuotasPendientesNuevas,
                    $i
                );

                Cuota::create([
                    'prestamo_id' => $prestamo->id,
                    'numero' => $numeroCuotaReal,
                    'monto' => $montoCuota,
                    'monto_pagado' => 0,
                    'mora' => 0,
                    'fecha_vencimiento' => $fecha,
                    'estado' => 'pendiente',
                    'fecha_pago' => null,
                    'metodo_pago' => null,
                    'referencia_pago' => null,
                ]);
            }

            $prestamo->update([
                'estado' => 'pendiente',
            ]);
        });

        return redirect()
            ->route('prestamos.show', $prestamo->id)
            ->with(
                'success',
                'Préstamo actualizado correctamente. Las cuotas pagadas fueron conservadas.'
            );
    }

    /**
     * Eliminar un préstamo.
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::findOrFail($id);

        DB::transaction(function () use ($prestamo) {
            /*
             * Primero eliminamos las cuotas.
             * Los pagos relacionados se eliminan por la relación
             * definida en la base de datos.
             */
            $prestamo->cuotas()->delete();

            $prestamo->delete();
        });

        return redirect()
            ->route('prestamos.index')
            ->with(
                'success',
                'Préstamo eliminado correctamente.'
            );
    }

    /**
     * Calcular la fecha de vencimiento de una cuota.
     */
    private function calcularFechaCuota(
        Carbon $fechaBase,
        string $frecuencia,
        int $numeroCuota
    ): Carbon {
        if ($frecuencia === 'diaria') {
            return $fechaBase
                ->copy()
                ->addDays($numeroCuota);
        }

        if ($frecuencia === 'semanal') {
            return $fechaBase
                ->copy()
                ->addWeeks($numeroCuota);
        }

        if ($frecuencia === 'quincenal') {
            return $fechaBase
                ->copy()
                ->addDays(15 * $numeroCuota);
        }

        return $this->calcularFechaMensual(
            $fechaBase,
            $numeroCuota
        );
    }

    /**
     * Calcular el monto de una cuota.
     *
     * La última cuota absorbe cualquier diferencia
     * producida por el redondeo de centavos.
     */
    private function calcularMontoCuota(
        float $total,
        float $cuotaBase,
        int $numeroCuotas,
        int $numeroActual
    ): float {
        if ($numeroActual === $numeroCuotas) {
            return round(
                $total - (
                    $cuotaBase * ($numeroCuotas - 1)
                ),
                2
            );
        }

        return $cuotaBase;
    }

    /**
     * Calcular correctamente las fechas mensuales.
     *
     * Mantiene el día original cuando existe en el mes.
     * Si no existe, utiliza el último día del mes.
     *
     * Ejemplo:
     * 30/01 → 28/02 → 30/03 → 30/04
     *
     * En año bisiesto:
     * 30/01 → 29/02 → 30/03
     */
    private function calcularFechaMensual(
        Carbon $fechaInicio,
        int $numeroCuota
    ): Carbon {
        $diaOriginal = $fechaInicio->day;

        $mesObjetivo = $fechaInicio
            ->copy()
            ->startOfMonth()
            ->addMonths($numeroCuota);

        $ultimoDiaDelMes = $mesObjetivo->daysInMonth;

        $diaFinal = min(
            $diaOriginal,
            $ultimoDiaDelMes
        );

        return $mesObjetivo->day($diaFinal);
    }
}