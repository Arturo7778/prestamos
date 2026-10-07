<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center
                                rounded-2xl bg-blue-100 text-xl
                                dark:bg-blue-900/40">
                        👤
                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                            {{ $cliente->nombre }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Información y resumen financiero del cliente
                        </p>

                    </div>

                </div>

            </div>


            <div class="flex flex-wrap gap-2">

                <a
                    href="{{ route('clientes.edit', $cliente) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                           bg-blue-600 px-4 py-2.5 text-sm font-semibold
                           text-white shadow-sm transition hover:bg-blue-700
                           focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    ✏️ Editar
                </a>

                <a
                    href="{{ route('clientes.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl
                           border border-gray-300 bg-white px-4 py-2.5
                           text-sm font-semibold text-gray-700 shadow-sm
                           transition hover:bg-gray-50
                           dark:border-gray-600 dark:bg-gray-800
                           dark:text-gray-200 dark:hover:bg-gray-700"
                >
                    ← Volver
                </a>

            </div>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">


            {{-- =========================================================
                 INFORMACIÓN DEL CLIENTE
            ========================================================== --}}

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


                {{-- Tarjeta principal --}}
                <div class="overflow-hidden rounded-3xl border border-gray-200
                            bg-white shadow-sm
                            dark:border-gray-700 dark:bg-gray-900
                            lg:col-span-2">

                    <div class="border-b border-gray-200 bg-gray-50 px-6 py-5
                                dark:border-gray-700 dark:bg-gray-800/70">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center
                                        rounded-xl bg-blue-100 text-lg
                                        dark:bg-blue-900/40">
                                🪪
                            </div>

                            <div>

                                <h3 class="font-bold text-gray-800 dark:text-white">
                                    Información personal
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Datos registrados del cliente
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="grid grid-cols-1 gap-6 p-6 sm:grid-cols-2">


                        {{-- DNI --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide
                                      text-gray-500 dark:text-gray-400">
                                DNI
                            </p>

                            <p class="mt-1 text-base font-bold text-gray-800
                                      dark:text-white">
                                {{ $cliente->dni }}
                            </p>

                        </div>


                        {{-- Nombre --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide
                                      text-gray-500 dark:text-gray-400">
                                Nombre completo
                            </p>

                            <p class="mt-1 text-base font-bold text-gray-800
                                      dark:text-white">
                                {{ $cliente->nombre }}
                            </p>

                        </div>


                        {{-- Teléfono --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide
                                      text-gray-500 dark:text-gray-400">
                                Teléfono
                            </p>

                            <p class="mt-1 text-base font-semibold text-gray-700
                                      dark:text-gray-200">
                                {{ $cliente->telefono ?: 'No registrado' }}
                            </p>

                        </div>


                        {{-- Correo --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide
                                      text-gray-500 dark:text-gray-400">
                                Correo electrónico
                            </p>

                            <p class="mt-1 break-all text-base font-semibold
                                      text-gray-700 dark:text-gray-200">
                                {{ $cliente->correo ?: 'No registrado' }}
                            </p>

                        </div>


                        {{-- Dirección --}}
                        <div class="sm:col-span-2">

                            <p class="text-xs font-semibold uppercase tracking-wide
                                      text-gray-500 dark:text-gray-400">
                                Dirección
                            </p>

                            <p class="mt-1 text-base font-semibold text-gray-700
                                      dark:text-gray-200">
                                {{ $cliente->direccion ?: 'No registrada' }}
                            </p>

                        </div>


                        {{-- Fecha de nacimiento --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide
                                      text-gray-500 dark:text-gray-400">
                                Fecha de nacimiento
                            </p>

                            <p class="mt-1 text-base font-semibold text-gray-700
                                      dark:text-gray-200">

                                @if ($cliente->fecha_nacimiento)

                                    {{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') }}

                                @else

                                    No registrada

                                @endif

                            </p>

                        </div>


                        {{-- Fecha de registro --}}
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide
                                      text-gray-500 dark:text-gray-400">
                                Cliente desde
                            </p>

                            <p class="mt-1 text-base font-semibold text-gray-700
                                      dark:text-gray-200">

                                @if ($cliente->created_at)

                                    {{ $cliente->created_at->format('d/m/Y') }}

                                @else

                                    No disponible

                                @endif

                            </p>

                        </div>

                    </div>

                </div>


                {{-- Resumen --}}
                <div class="rounded-3xl border border-gray-200 bg-white p-6
                            shadow-sm dark:border-gray-700 dark:bg-gray-900">

                    <div class="mb-5">

                        <h3 class="font-bold text-gray-800 dark:text-white">
                            📊 Resumen financiero
                        </h3>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Estado general del cliente
                        </p>

                    </div>


                    @php

                        $totalPrestamos = $cliente->prestamos->count();

                        $prestamosActivos = $cliente->prestamos
                            ->whereIn('estado', ['activo', 'vencido'])
                            ->count();

                        $montoPrestado = $cliente->prestamos
                            ->sum('monto');

                        $totalPagado = $cliente->prestamos
                            ->flatMap(fn ($prestamo) => $prestamo->cuotas)
                            ->flatMap(fn ($cuota) => $cuota->pagos)
                            ->sum('monto');

                    @endphp


                    <div class="space-y-4">


                        {{-- Préstamos --}}
                        <div class="rounded-2xl bg-gray-50 p-4
                                    dark:bg-gray-800">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    Préstamos registrados
                                </span>

                                <span class="text-lg font-bold text-gray-800
                                             dark:text-white">
                                    {{ $totalPrestamos }}
                                </span>

                            </div>

                        </div>


                        {{-- Activos --}}
                        <div class="rounded-2xl bg-emerald-50 p-4
                                    dark:bg-emerald-950/30">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-emerald-700
                                             dark:text-emerald-400">
                                    Préstamos activos
                                </span>

                                <span class="text-lg font-bold text-emerald-700
                                             dark:text-emerald-400">
                                    {{ $prestamosActivos }}
                                </span>

                            </div>

                        </div>


                        {{-- Prestado --}}
                        <div class="rounded-2xl bg-blue-50 p-4
                                    dark:bg-blue-950/30">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-blue-700
                                             dark:text-blue-400">
                                    Total prestado
                                </span>

                                <span class="text-lg font-bold text-blue-700
                                             dark:text-blue-400">
                                    S/ {{ number_format($montoPrestado, 2) }}
                                </span>

                            </div>

                        </div>


                        {{-- Pagado --}}
                        <div class="rounded-2xl bg-violet-50 p-4
                                    dark:bg-violet-950/30">

                            <div class="flex items-center justify-between">

                                <span class="text-sm text-violet-700
                                             dark:text-violet-400">
                                    Total pagado
                                </span>

                                <span class="text-lg font-bold text-violet-700
                                             dark:text-violet-400">
                                    S/ {{ number_format($totalPagado, 2) }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =========================================================
                 PRÉSTAMOS DEL CLIENTE
            ========================================================== --}}

            <div class="overflow-hidden rounded-3xl border border-gray-200
                        bg-white shadow-sm
                        dark:border-gray-700 dark:bg-gray-900">


                <div class="border-b border-gray-200 bg-gray-50 px-6 py-5
                            dark:border-gray-700 dark:bg-gray-800/70">

                    <div class="flex items-center justify-between gap-4">

                        <div>

                            <h3 class="font-bold text-gray-800 dark:text-white">
                                💰 Préstamos del cliente
                            </h3>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Historial de préstamos registrados
                            </p>

                        </div>

                        <div class="rounded-full bg-blue-100 px-3 py-1 text-sm
                                    font-bold text-blue-700
                                    dark:bg-blue-900/40 dark:text-blue-400">
                            {{ $totalPrestamos }}
                        </div>

                    </div>

                </div>


                @if ($cliente->prestamos->count())

                    <div class="overflow-x-auto">

                        <table class="min-w-full text-left">

                            <thead class="bg-gray-100 dark:bg-gray-800">

                                <tr>

                                    <th class="px-6 py-4 text-xs font-bold uppercase
                                               tracking-wider text-gray-500
                                               dark:text-gray-400">
                                        Préstamo
                                    </th>

                                    <th class="px-6 py-4 text-xs font-bold uppercase
                                               tracking-wider text-gray-500
                                               dark:text-gray-400">
                                        Monto
                                    </th>

                                    <th class="px-6 py-4 text-xs font-bold uppercase
                                               tracking-wider text-gray-500
                                               dark:text-gray-400">
                                        Cuotas
                                    </th>

                                    <th class="px-6 py-4 text-xs font-bold uppercase
                                               tracking-wider text-gray-500
                                               dark:text-gray-400">
                                        Frecuencia
                                    </th>

                                    <th class="px-6 py-4 text-xs font-bold uppercase
                                               tracking-wider text-gray-500
                                               dark:text-gray-400">
                                        Inicio
                                    </th>

                                    <th class="px-6 py-4 text-xs font-bold uppercase
                                               tracking-wider text-gray-500
                                               dark:text-gray-400">
                                        Estado
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                                @foreach ($cliente->prestamos as $prestamo)

                                    <tr class="transition hover:bg-gray-50
                                               dark:hover:bg-gray-800/50">


                                        {{-- ID --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <span class="font-bold text-gray-800
                                                         dark:text-white">
                                                #{{ $prestamo->id }}
                                            </span>

                                        </td>


                                        {{-- Monto --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <span class="font-bold text-gray-800
                                                         dark:text-white">
                                                S/ {{ number_format($prestamo->monto, 2) }}
                                            </span>

                                        </td>


                                        {{-- Cuotas --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <span class="text-gray-700 dark:text-gray-300">
                                                {{ $prestamo->numero_cuotas }}
                                            </span>

                                        </td>


                                        {{-- Frecuencia --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            @php
                                                $frecuencia = [
                                                    'diaria' => 'Diaria',
                                                    'semanal' => 'Semanal',
                                                    'quincenal' => 'Quincenal',
                                                    'mensual' => 'Mensual',
                                                ];
                                            @endphp

                                            <span class="text-gray-700 dark:text-gray-300">
                                                {{ $frecuencia[$prestamo->frecuencia] ?? ucfirst($prestamo->frecuencia) }}
                                            </span>

                                        </td>


                                        {{-- Fecha --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            <span class="text-gray-700 dark:text-gray-300">

                                                @if ($prestamo->fecha_inicio)

                                                    {{ \Carbon\Carbon::parse($prestamo->fecha_inicio)->format('d/m/Y') }}

                                                @else

                                                    —

                                                @endif

                                            </span>

                                        </td>


                                        {{-- Estado --}}
                                        <td class="whitespace-nowrap px-6 py-4">

                                            @php

                                                $estadoClase = match ($prestamo->estado) {

                                                    'activo' =>
                                                        'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400',

                                                    'pagado' =>
                                                        'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400',

                                                    'vencido' =>
                                                        'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400',

                                                    default =>
                                                        'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',

                                                };

                                            @endphp

                                            <span
                                                class="inline-flex rounded-full px-3 py-1
                                                       text-xs font-bold {{ $estadoClase }}"
                                            >
                                                {{ ucfirst($prestamo->estado) }}
                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="px-6 py-12 text-center">

                        <div class="text-4xl">
                            💰
                        </div>

                        <h4 class="mt-3 font-bold text-gray-800 dark:text-white">
                            Sin préstamos registrados
                        </h4>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Este cliente todavía no tiene préstamos registrados.
                        </p>

                    </div>

                @endif

            </div>



            {{-- =========================================================
                 RESUMEN DE CUOTAS
            ========================================================== --}}

            @php

                $todasLasCuotas = $cliente->prestamos
                    ->flatMap(fn ($prestamo) => $prestamo->cuotas);

                $cuotasPendientes = $todasLasCuotas
                    ->where('estado', 'pendiente')
                    ->count();

                $cuotasPagadas = $todasLasCuotas
                    ->where('estado', 'pagada')
                    ->count();

                $cuotasVencidas = $todasLasCuotas
                    ->where('estado', 'vencida')
                    ->count();

            @endphp


            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">


                {{-- Pendientes --}}
                <div class="rounded-3xl border border-gray-200 bg-white p-5
                            shadow-sm dark:border-gray-700 dark:bg-gray-900">

                    <div class="flex items-center gap-4">

                        <div class="flex h-11 w-11 items-center justify-center
                                    rounded-2xl bg-amber-100 text-xl
                                    dark:bg-amber-900/40">
                            ⏳
                        </div>

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Cuotas pendientes
                            </p>

                            <p class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ $cuotasPendientes }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Pagadas --}}
                <div class="rounded-3xl border border-gray-200 bg-white p-5
                            shadow-sm dark:border-gray-700 dark:bg-gray-900">

                    <div class="flex items-center gap-4">

                        <div class="flex h-11 w-11 items-center justify-center
                                    rounded-2xl bg-emerald-100 text-xl
                                    dark:bg-emerald-900/40">
                            ✅
                        </div>

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Cuotas pagadas
                            </p>

                            <p class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ $cuotasPagadas }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Vencidas --}}
                <div class="rounded-3xl border border-gray-200 bg-white p-5
                            shadow-sm dark:border-gray-700 dark:bg-gray-900">

                    <div class="flex items-center gap-4">

                        <div class="flex h-11 w-11 items-center justify-center
                                    rounded-2xl bg-red-100 text-xl
                                    dark:bg-red-900/40">
                            🚨
                        </div>

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Cuotas vencidas
                            </p>

                            <p class="text-2xl font-bold text-gray-800 dark:text-white">
                                {{ $cuotasVencidas }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

</x-app-layout>