<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    💰 Detalle del préstamo
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Cronograma, pagos, mora y estado financiero del préstamo.
                </p>
            </div>
            <a href="{{ route('prestamos.index') }}" class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                ← Volver a préstamos
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="px-4 sm:px-6 lg:px-8">
<style>
    .contenedor {
        max-width: 1280px;
        margin: 0 auto;
    }

    .cabecera,
    .resumen,
    .cronograma {
        background: #111827;
        border: 1px solid #1f2937;
        color: #f9fafb;
        border-radius: 20px;
        box-shadow: 0 18px 45px rgba(0,0,0,.18);
    }

    .cabecera {
        padding: 26px;
        margin-bottom: 24px;
    }

    .cabecera h1,
    .resumen h2,
    .cronograma h2 {
        color: #f9fafb;
    }

    .cabecera h1 {
        margin: 0 0 18px;
        font-size: 28px;
        font-weight: 800;
    }

    .informacion {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 14px;
    }

    .dato {
        background: #0f172a;
        padding: 15px;
        border-radius: 14px;
        border: 1px solid #263247;
    }

    .dato span,
    .resumen-card span {
        display: block;
        font-size: 13px;
        color: #94a3b8;
        margin-bottom: 6px;
    }

    .dato strong {
        font-size: 16px;
        color: #f8fafc;
    }

    .resumen {
        padding: 26px;
        margin-bottom: 24px;
    }

    .resumen h2 {
        margin: 0 0 20px;
        font-size: 23px;
        font-weight: 800;
    }

    .resumen-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 14px;
    }

    .resumen-card {
        padding: 18px;
        border-radius: 15px;
        border: 1px solid #293548;
        background: #0f172a;
    }

    .resumen-card strong {
        display: block;
        font-size: 21px;
        color: #f8fafc;
    }

    .resumen-total { background: #0f2530; border-color: #0f766e; }
    .resumen-pagado { background: #0c2a24; border-color: #047857; }
    .resumen-restante { background: #2b2110; border-color: #a16207; }
    .resumen-mora { background: #30151b; border-color: #be123c; }
    .resumen-cuotas { background: #211c3a; border-color: #6d5bd0; }

    .cronograma {
        padding: 26px;
        overflow-x: auto;
    }

    .cronograma h2 {
        margin: 0 0 22px;
        font-size: 23px;
        font-weight: 800;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 1100px;
        overflow: hidden;
        border: 1px solid #263247;
        border-radius: 14px;
    }

    thead { background: #0b1220; color: #e5e7eb; }

    th {
        padding: 14px;
        text-align: left;
        font-size: 13px;
        font-weight: 800;
        border-bottom: 1px solid #263247;
    }

    td {
        padding: 15px 14px;
        border-bottom: 1px solid #1f2937;
        vertical-align: top;
        color: #d1d5db;
    }

    tbody tr { background: #111827; }
    tbody tr:hover { background: #172033; }
    tbody tr:last-child td { border-bottom: 0; }

    .estado { display: inline-flex; align-items: center; gap: 7px; font-weight: 800; }
    .pagado { color: #34d399; }
    .parcial { color: #60a5fa; }
    .pendiente { color: #fbbf24; }
    .vencido { color: #f87171; }

    .detalle-mora {
        background: #30151b;
        border: 1px solid #7f1d1d;
        padding: 10px 12px;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .dias-atraso, .mora { color: #f87171; font-weight: 800; margin-bottom: 5px; }
    .total-mora { color: #fca5a5; font-weight: 800; }

    .pago-resumen {
        background: #0f172a;
        border: 1px solid #293548;
        padding: 10px 12px;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .pago-resumen div { margin-bottom: 4px; }
    .pago-resumen div:last-child { margin-bottom: 0; }
    .pago-resumen strong { color: #f8fafc; }
    .saldo-cuota { color: #f87171; font-weight: 800; }

    .historial {
        margin-top: 12px;
        border: 1px solid #1d4ed8;
        background: #0f1f3d;
        border-radius: 12px;
        padding: 10px;
    }

    .historial-titulo { font-weight: 800; color: #93c5fd; margin-bottom: 8px; }

    .pago-item {
        background: #111827;
        border: 1px solid #293548;
        border-radius: 9px;
        padding: 9px 10px;
        margin-bottom: 7px;
    }

    .pago-item:last-child { margin-bottom: 0; }
    .pago-item strong { color: #34d399; }
    .pago-datos { display: flex; flex-wrap: wrap; gap: 8px 14px; font-size: 13px; color: #94a3b8; margin-top: 4px; }
    .sin-pagos, .sin-mora { color: #94a3b8; font-size: 13px; }

    .formulario-pago { display: flex; flex-direction: column; gap: 8px; min-width: 220px; }

    .formulario-pago input,
    .formulario-pago select {
        width: 100%;
        padding: 10px;
        border: 1px solid #334155;
        border-radius: 9px;
        font-size: 14px;
        background: #0f172a;
        color: #f8fafc;
    }

    .formulario-pago input:focus,
    .formulario-pago select:focus {
        outline: none;
        border-color: #10b981;
        box-shadow: 0 0 0 2px rgba(16,185,129,.15);
    }

    .btn-pagar {
        border: none;
        background: #059669;
        color: white;
        padding: 10px 15px;
        border-radius: 9px;
        cursor: pointer;
        font-weight: 800;
        font-size: 14px;
        transition: .2s;
    }

    .btn-pagar:hover { background: #047857; transform: translateY(-1px); }
    .pago-registrado { color: #34d399; font-weight: 800; }

    .btn-volver {
        display: inline-block;
        margin-top: 20px;
        padding: 11px 18px;
        background: #1f2937;
        color: #e5e7eb;
        text-decoration: none;
        border: 1px solid #374151;
        border-radius: 10px;
        font-weight: 800;
        transition: .2s;
    }

    .btn-volver:hover { background: #374151; }

    .mensaje {
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .mensaje-success { background: #052e2b; color: #6ee7b7; border: 1px solid #047857; }
    .mensaje-error { background: #3b1018; color: #fca5a5; border: 1px solid #991b1b; }

    @media (max-width: 700px) {
        .cabecera, .resumen, .cronograma { padding: 18px; }
        .cabecera h1 { font-size: 23px; }
        .resumen-card strong { font-size: 18px; }
    }
</style>
<div class="contenedor">





{{-- ============================================================

     MENSAJES

============================================================ --}}



@if(session('success'))



    <div class="mensaje mensaje-success">

        ✅ {{ session('success') }}

    </div>



@endif



@if(session('error'))



    <div class="mensaje mensaje-error">

        ⚠️ {{ session('error') }}

    </div>



@endif





{{-- ============================================================

     INFORMACIÓN DEL PRÉSTAMO

============================================================ --}}



<div class="cabecera">



    <h1>💰 Detalle del préstamo</h1>



    <div class="informacion">



        <div class="dato">

            <span>Cliente</span>

            <strong>{{ $prestamo->cliente->nombre }}</strong>

        </div>



        <div class="dato">

            <span>DNI</span>

            <strong>{{ $prestamo->cliente->dni }}</strong>

        </div>



        <div class="dato">

            <span>Monto prestado</span>

            <strong>

                S/ {{ number_format($prestamo->monto, 2) }}

            </strong>

        </div>



        <div class="dato">

            <span>Tasa de interés</span>

            <strong>{{ $prestamo->tasa_interes }}%</strong>

        </div>



        <div class="dato">

            <span>Mora diaria</span>

            <strong>{{ $prestamo->tasa_mora_diaria }}%</strong>

        </div>



        <div class="dato">

            <span>Número de cuotas</span>

            <strong>{{ $prestamo->numero_cuotas }}</strong>

        </div>



        <div class="dato">

            <span>Frecuencia</span>

            <strong>{{ ucfirst($prestamo->frecuencia) }}</strong>

        </div>



        <div class="dato">

            <span>Estado</span>

            <strong>{{ ucfirst($prestamo->estado) }}</strong>

        </div>



    </div>



</div>





{{-- ============================================================

     CÁLCULOS FINANCIEROS

============================================================ --}}



@php



    $montoBase = (float) $prestamo->monto;



    $tasaInteres = (float) $prestamo->tasa_interes;



    $interesTotal = round(

        $montoBase * ($tasaInteres / 100),

        2

    );



    $totalPrestamo = round(

        $montoBase + $interesTotal,

        2

    );





    /*

    |--------------------------------------------------------------------------

    | TOTAL PAGADO

    |--------------------------------------------------------------------------

    |

    | Solo reduce la deuda principal.

    | La mora se muestra aparte.

    |

    */



    $totalPagado = 0;



    foreach ($prestamo->cuotas as $cuota) {



        $montoCuota = (float) $cuota->monto;



        $montoPagadoCuota = (float) ($cuota->monto_pagado ?? 0);



        $pagoAplicado = min(

            $montoPagadoCuota,

            $montoCuota

        );



        $totalPagado += $pagoAplicado;

    }



    $totalPagado = round($totalPagado, 2);





    $deudaRestante = max(

        0,

        round(

            $totalPrestamo - $totalPagado,

            2

        )

    );





    $totalCuotas = $prestamo->cuotas->count();



    $cuotasPagadas = $prestamo->cuotas

        ->where('estado', 'pagado')

        ->count();



    $cuotasParciales = $prestamo->cuotas

        ->where('estado', 'parcial')

        ->count();



    $cuotasPendientes = $prestamo->cuotas

        ->whereIn('estado', ['pendiente', 'vencida', 'parcial'])

        ->count();





    $moraTotal = round(

        $prestamo->cuotas->sum('mora'),

        2

    );





    /*

    |--------------------------------------------------------------------------

    | SALDO DE LAS CUOTAS PENDIENTES

    |--------------------------------------------------------------------------

    */



    $saldoPendienteTotal = 0;



    foreach ($prestamo->cuotas as $cuota) {



        if ($cuota->estado !== 'pagado') {



            $montoCuota = (float) $cuota->monto;



            $pagado = (float) ($cuota->monto_pagado ?? 0);



            $saldoPendienteTotal += max(

                0,

                $montoCuota - $pagado

            );

        }

    }



    $saldoPendienteTotal = round(

        $saldoPendienteTotal,

        2

    );



@endphp





{{-- ============================================================

     RESUMEN FINANCIERO

============================================================ --}}



<div class="resumen">



    <h2>📊 Resumen financiero</h2>



    <div class="resumen-grid">



        <div class="resumen-card resumen-total">



            <span>💰 Total del préstamo</span>



            <strong>

                S/ {{ number_format($totalPrestamo, 2) }}

            </strong>



        </div>





        <div class="resumen-card resumen-pagado">



            <span>✅ Total pagado</span>



            <strong>

                S/ {{ number_format($totalPagado, 2) }}

            </strong>



        </div>





        <div class="resumen-card resumen-restante">



            <span>🟡 Deuda restante</span>



            <strong>

                S/ {{ number_format($deudaRestante, 2) }}

            </strong>



        </div>





        <div class="resumen-card resumen-cuotas">



            <span>✅ Cuotas pagadas</span>



            <strong>

                {{ $cuotasPagadas }}

            </strong>



        </div>





        <div class="resumen-card resumen-cuotas">



            <span>🔵 Cuotas parciales</span>



            <strong>

                {{ $cuotasParciales }}

            </strong>



        </div>





        <div class="resumen-card resumen-cuotas">



            <span>⏳ Cuotas pendientes</span>



            <strong>

                {{ $cuotasPendientes }}

            </strong>



        </div>





        <div class="resumen-card resumen-mora">



            <span>💸 Mora acumulada</span>



            <strong>

                S/ {{ number_format($moraTotal, 2) }}

            </strong>



        </div>



    </div>



</div>





{{-- ============================================================

     CRONOGRAMA

============================================================ --}}



<div class="cronograma">



    <h2>

        🗓️ Cronograma de pagos

    </h2>





    <table>



        <thead>



            <tr>



                <th>Cuota</th>

                <th>Vencimiento</th>

                <th>Monto</th>

                <th>Pagado</th>

                <th>Estado</th>

                <th>Acción / Historial</th>



            </tr>



        </thead>





        <tbody>





        @foreach($prestamo->cuotas as $cuota)



            @php



                /*

                |--------------------------------------------------------------------------

                | MORA

                |--------------------------------------------------------------------------

                */



                $diasAtraso = 0;



                $mora = 0;





                if (

                    $cuota->estado !== 'pagado' &&

                    $cuota->fecha_vencimiento

                        ->startOfDay()

                        ->isPast()

                ) {



                    $diasAtraso =

                        $cuota->fecha_vencimiento

                            ->startOfDay()

                            ->diffInDays(

                                now()->startOfDay()

                            );





                    $tasaMora =

                        (float) $prestamo->tasa_mora_diaria;





                    $mora = round(



                        (float) $cuota->monto

                        * ($tasaMora / 100)

                        * $diasAtraso,



                        2

                    );

                }





                /*

                |--------------------------------------------------------------------------

                | TOTAL DE LA CUOTA

                |--------------------------------------------------------------------------

                */



                $montoCuota =

                    (float) $cuota->monto;



                $montoPagado =

                    (float) ($cuota->monto_pagado ?? 0);





                $totalConMora = round(

                    $montoCuota + $mora,

                    2

                );





                $saldoCuota = max(

                    0,

                    round(

                        $totalConMora - $montoPagado,

                        2

                    )

                );



            @endphp





            <tr>



                {{-- CUOTA --}}



                <td>



                    <strong>

                        #{{ $cuota->numero }}

                    </strong>



                </td>





                {{-- VENCIMIENTO --}}



                <td>



                    {{ $cuota->fecha_vencimiento->format('d/m/Y') }}



                </td>





                {{-- MONTO --}}



                <td>



                    <strong>

                        S/

                        {{ number_format($montoCuota, 2) }}

                    </strong>



                </td>





                {{-- PAGADO --}}



                <td>



                    <div class="pago-resumen">



                        <div>

                            <strong>

                                S/

                                {{ number_format($montoPagado, 2) }}

                            </strong>

                        </div>



                        @if($cuota->estado !== 'pagado')



                            <div class="saldo-cuota">



                                Falta:



                                S/

                                {{ number_format($saldoCuota, 2) }}



                            </div>



                        @endif



                    </div>



                </td>





                {{-- ESTADO --}}



                <td>



                    @if($cuota->estado === 'pagado')



                        <span class="estado pagado">

                            🟢 Pagado

                        </span>



                    @elseif($cuota->estado === 'parcial')



                        <span class="estado parcial">

                            🔵 Parcial

                        </span>



                    @elseif($diasAtraso > 0)



                        <span class="estado vencido">

                            🔴 Vencido

                        </span>



                    @else



                        <span class="estado pendiente">

                            🟡 Pendiente

                        </span>



                    @endif



                </td>





                {{-- ACCIÓN / HISTORIAL --}}



                <td>





                    {{-- =================================================

                         HISTORIAL DE PAGOS

                    ================================================== --}}



                    <div class="historial">



                        <div class="historial-titulo">

                            📜 Historial de pagos

                        </div>





                        @forelse($cuota->pagos as $pago)



                            <div class="pago-item">



                                <strong>

                                    S/

                                    {{ number_format($pago->monto, 2) }}

                                </strong>





                                <div class="pago-datos">



                                    <span>

                                        📅

                                        {{ optional($pago->fecha_pago)->format('d/m/Y') }}

                                    </span>





                                    <span>

                                        @if($pago->metodo_pago === 'efectivo')

                                            💵 Efectivo

                                        @elseif($pago->metodo_pago === 'yape')

                                            📱 Yape

                                        @elseif($pago->metodo_pago === 'plin')

                                            📱 Plin

                                        @elseif($pago->metodo_pago === 'transferencia')

                                            🏦 Transferencia

                                        @else

                                            {{ ucfirst($pago->metodo_pago) }}

                                        @endif

                                    </span>





                                    @if($pago->referencia_pago)



                                        <span>

                                            🔖

                                            {{ $pago->referencia_pago }}

                                        </span>



                                    @endif



                                </div>



                            </div>



                        @empty



                            <div class="sin-pagos">



                                No existen pagos registrados.



                            </div>



                        @endforelse



                    </div>





                    {{-- =================================================

                         MORA

                    ================================================== --}}



                    @if($cuota->estado !== 'pagado')



                        @if($diasAtraso > 0)



                            <div class="detalle-mora">



                                <div class="dias-atraso">



                                    ⏰

                                    {{ $diasAtraso }}

                                    {{ $diasAtraso == 1 ? 'día' : 'días' }}

                                    de atraso



                                </div>





                                <div class="mora">



                                    💸 Mora:



                                    S/

                                    {{ number_format($mora, 2) }}



                                </div>





                                <div class="total-mora">



                                    💰 Total con mora:



                                    S/

                                    {{ number_format($totalConMora, 2) }}



                                </div>



                            </div>



                        @else



                            <div class="sin-mora">



                                Sin mora



                            </div>



                        @endif





                        {{-- =================================================

                             FORMULARIO DE PAGO

                        ================================================== --}}



                        <form

                            action="{{ route('cuotas.pagar', $cuota->id) }}"

                            method="POST"

                        >



                            @csrf





                            <input

                                type="number"

                                name="monto_pagado"

                                value="{{ number_format($saldoCuota, 2, '.', '') }}"

                                min="0.01"

                                max="{{ number_format($saldoCuota, 2, '.', '') }}"

                                step="0.01"

                                required

                            >





                            <input

                                type="date"

                                name="fecha_pago"

                                value="{{ date('Y-m-d') }}"

                                required

                            >





                            <select

                                name="metodo_pago"

                                required

                            >



                                <option value="">

                                    Método de pago

                                </option>



                                <option value="efectivo">

                                    💵 Efectivo

                                </option>



                                <option value="yape">

                                    📱 Yape

                                </option>



                                <option value="plin">

                                    📱 Plin

                                </option>



                                <option value="transferencia">

                                    🏦 Transferencia

                                </option>



                            </select>





                            <input

                                type="text"

                                name="referencia_pago"

                                placeholder="Referencia / N.º operación"

                                maxlength="255"

                            >





                            <button

                                type="submit"

                                class="btn-pagar"

                            >



                                💰 Registrar pago



                            </button>



                        </form>



                    @else



                        <div class="pago-registrado">



                            ✔️ Cuota pagada completamente



                        </div>



                    @endif



                </td>



            </tr>





        @endforeach





        </tbody>



    </table>





    {{-- VOLVER --}}



    <a

        href="/prestamos"

        class="btn-volver"

    >

        ← Volver a préstamos

    </a>



</div>
        </div>
    </div>

</x-app-layout>
