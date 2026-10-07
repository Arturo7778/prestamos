<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    💰 Registrar nuevo préstamo
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Registra un nuevo préstamo y configura sus condiciones de pago.
                </p>
            </div>

            <a
                href="{{ route('prestamos.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-gray-300
                       bg-white px-4 py-2 text-sm font-semibold text-gray-700
                       shadow-sm transition hover:bg-gray-50
                       dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200
                       dark:hover:bg-gray-700"
            >
                ← Volver a préstamos
            </a>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            {{-- Errores de validación --}}
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5
                            dark:border-red-900 dark:bg-red-950/40">

                    <div class="flex items-start gap-3">

                        <div class="text-xl">
                            ⚠️
                        </div>

                        <div>
                            <h3 class="font-bold text-red-800 dark:text-red-300">
                                Hay errores en el formulario
                            </h3>

                            <ul class="mt-2 list-inside list-disc space-y-1 text-sm
                                       text-red-700 dark:text-red-400">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>
                        </div>

                    </div>
                </div>
            @endif


            {{-- Tarjeta principal --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200
                        bg-white shadow-xl dark:border-gray-700 dark:bg-gray-900">

                {{-- Encabezado --}}
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-5
                            dark:border-gray-700 dark:bg-gray-800/70">

                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center
                                    rounded-2xl bg-emerald-100 text-2xl
                                    dark:bg-emerald-900/40">
                            💰
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Información del préstamo
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Completa los datos para generar el préstamo.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- Formulario --}}
                <form method="POST" action="{{ route('prestamos.store') }}">

                    @csrf

                    <div class="space-y-8 p-6 sm:p-8">


                        {{-- Cliente --}}
                        <div>

                            <label
                                for="cliente_id"
                                class="mb-2 block text-sm font-semibold text-gray-700
                                       dark:text-gray-200"
                            >
                                Cliente
                            </label>

                            <select
                                id="cliente_id"
                                name="cliente_id"
                                required
                                class="block w-full rounded-xl border-gray-300 bg-white
                                       px-4 py-3 text-sm text-gray-900 shadow-sm
                                       transition focus:border-emerald-500
                                       focus:ring-emerald-500
                                       dark:border-gray-600 dark:bg-gray-800
                                       dark:text-white"
                            >

                                <option value="">
                                    -- Seleccionar cliente --
                                </option>

                                @foreach ($clientes as $cliente)

                                    <option
                                        value="{{ $cliente->id }}"
                                        {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}
                                    >
                                        {{ $cliente->nombre }} - DNI: {{ $cliente->dni }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Datos financieros --}}
                        <div>

                            <div class="mb-4">

                                <h4 class="text-base font-bold text-gray-800 dark:text-white">
                                    💵 Condiciones financieras
                                </h4>

                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Define el monto y las condiciones del préstamo.
                                </p>

                            </div>


                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


                                {{-- Monto --}}
                                <div>

                                    <label
                                        for="monto"
                                        class="mb-2 block text-sm font-semibold
                                               text-gray-700 dark:text-gray-200"
                                    >
                                        Monto del préstamo
                                    </label>

                                    <div class="relative">

                                        <span
                                            class="pointer-events-none absolute inset-y-0 left-0
                                                   flex items-center pl-4 text-sm font-semibold
                                                   text-gray-500 dark:text-gray-400"
                                        >
                                            S/
                                        </span>

                                        <input
                                            id="monto"
                                            type="number"
                                            name="monto"
                                            step="0.01"
                                            min="0"
                                            required
                                            value="{{ old('monto') }}"
                                            placeholder="0.00"
                                            class="block w-full rounded-xl border-gray-300
                                                   bg-white py-3 pl-11 pr-4 text-sm
                                                   text-gray-900 shadow-sm transition
                                                   focus:border-emerald-500
                                                   focus:ring-emerald-500
                                                   dark:border-gray-600 dark:bg-gray-800
                                                   dark:text-white"
                                        >

                                    </div>

                                </div>


                                {{-- Tasa --}}
                                <div>

                                    <label
                                        for="tasa_interes"
                                        class="mb-2 block text-sm font-semibold
                                               text-gray-700 dark:text-gray-200"
                                    >
                                        Tasa de interés
                                    </label>

                                    <div class="relative">

                                        <input
                                            id="tasa_interes"
                                            type="number"
                                            name="tasa_interes"
                                            step="0.01"
                                            min="0"
                                            required
                                            value="{{ old('tasa_interes') }}"
                                            placeholder="0.00"
                                            class="block w-full rounded-xl border-gray-300
                                                   bg-white py-3 pl-4 pr-10 text-sm
                                                   text-gray-900 shadow-sm transition
                                                   focus:border-emerald-500
                                                   focus:ring-emerald-500
                                                   dark:border-gray-600 dark:bg-gray-800
                                                   dark:text-white"
                                        >

                                        <span
                                            class="pointer-events-none absolute inset-y-0 right-0
                                                   flex items-center pr-4 text-sm font-semibold
                                                   text-gray-500 dark:text-gray-400"
                                        >
                                            %
                                        </span>

                                    </div>

                                </div>


                                {{-- Número de cuotas --}}
                                <div>

                                    <label
                                        for="numero_cuotas"
                                        class="mb-2 block text-sm font-semibold
                                               text-gray-700 dark:text-gray-200"
                                    >
                                        Número de cuotas
                                    </label>

                                    <input
                                        id="numero_cuotas"
                                        type="number"
                                        name="numero_cuotas"
                                        min="1"
                                        required
                                        value="{{ old('numero_cuotas') }}"
                                        placeholder="Ej. 12"
                                        class="block w-full rounded-xl border-gray-300
                                               bg-white px-4 py-3 text-sm text-gray-900
                                               shadow-sm transition focus:border-emerald-500
                                               focus:ring-emerald-500
                                               dark:border-gray-600 dark:bg-gray-800
                                               dark:text-white"
                                    >

                                </div>


                                {{-- Frecuencia --}}
                                <div>

                                    <label
                                        for="frecuencia"
                                        class="mb-2 block text-sm font-semibold
                                               text-gray-700 dark:text-gray-200"
                                    >
                                        Frecuencia de pago
                                    </label>

                                    <select
                                        id="frecuencia"
                                        name="frecuencia"
                                        required
                                        class="block w-full rounded-xl border-gray-300
                                               bg-white px-4 py-3 text-sm text-gray-900
                                               shadow-sm transition focus:border-emerald-500
                                               focus:ring-emerald-500
                                               dark:border-gray-600 dark:bg-gray-800
                                               dark:text-white"
                                    >

                                        <option value="">
                                            -- Seleccionar frecuencia --
                                        </option>

                                        <option
                                            value="diaria"
                                            {{ old('frecuencia') == 'diaria' ? 'selected' : '' }}
                                        >
                                            Diaria
                                        </option>

                                        <option
                                            value="semanal"
                                            {{ old('frecuencia') == 'semanal' ? 'selected' : '' }}
                                        >
                                            Semanal
                                        </option>

                                        <option
                                            value="quincenal"
                                            {{ old('frecuencia') == 'quincenal' ? 'selected' : '' }}
                                        >
                                            Quincenal
                                        </option>

                                        <option
                                            value="mensual"
                                            {{ old('frecuencia') == 'mensual' ? 'selected' : '' }}
                                        >
                                            Mensual
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>


                        {{-- Fecha --}}
                        <div class="border-t border-gray-200 pt-6
                                    dark:border-gray-700">

                            <label
                                for="fecha_inicio"
                                class="mb-2 block text-sm font-semibold
                                       text-gray-700 dark:text-gray-200"
                            >
                                📅 Fecha de inicio
                            </label>

                            <input
                                id="fecha_inicio"
                                type="date"
                                name="fecha_inicio"
                                required
                                value="{{ old('fecha_inicio', date('Y-m-d')) }}"
                                class="block w-full rounded-xl border-gray-300 bg-white
                                       px-4 py-3 text-sm text-gray-900 shadow-sm
                                       transition focus:border-emerald-500
                                       focus:ring-emerald-500
                                       dark:border-gray-600 dark:bg-gray-800
                                       dark:text-white sm:max-w-xs"
                            >

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-gray-200
                                bg-gray-50 px-6 py-5 sm:flex-row sm:justify-end
                                dark:border-gray-700 dark:bg-gray-800/50">

                        <a
                            href="{{ route('prestamos.index') }}"
                            class="inline-flex items-center justify-center rounded-xl
                                   border border-gray-300 bg-white px-5 py-3 text-sm
                                   font-semibold text-gray-700 shadow-sm transition
                                   hover:bg-gray-50
                                   dark:border-gray-600 dark:bg-gray-800
                                   dark:text-gray-200 dark:hover:bg-gray-700"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   rounded-xl bg-emerald-600 px-6 py-3 text-sm
                                   font-bold text-white shadow-sm transition
                                   hover:bg-emerald-700 focus:outline-none
                                   focus:ring-2 focus:ring-emerald-500
                                   focus:ring-offset-2"
                        >
                            💾 Registrar préstamo
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>