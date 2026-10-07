<x-app-layout>

    {{-- ============================================================
        HEADER
    ============================================================= --}}
    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Editar préstamo
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Modifica la información del préstamo #{{ $prestamo->id }}
                </p>
            </div>

            <a href="{{ route('prestamos.show', $prestamo->id) }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2
                      rounded-lg border border-gray-300 dark:border-gray-700
                      bg-white dark:bg-gray-800
                      text-sm font-semibold text-gray-700 dark:text-gray-200
                      hover:bg-gray-50 dark:hover:bg-gray-700
                      transition">

                ← Volver al préstamo

            </a>

        </div>

    </x-slot>


    {{-- ============================================================
        CONTENIDO
    ============================================================= --}}
    <div class="min-h-screen bg-gray-100 dark:bg-gray-950">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ====================================================
                ERRORES
            ===================================================== --}}
            @if($errors->any())

                <div class="mb-6 rounded-xl border border-red-200
                            bg-red-50 dark:bg-red-900/20 dark:border-red-800
                            p-5">

                    <div class="flex items-start gap-3">

                        <div class="text-xl">
                            ⚠️
                        </div>

                        <div>

                            <h3 class="font-semibold text-red-800 dark:text-red-300">
                                No se pudo actualizar el préstamo
                            </h3>

                            <ul class="mt-2 list-disc list-inside text-sm
                                       text-red-700 dark:text-red-400">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ====================================================
                INFORMACIÓN DEL PRÉSTAMO
            ===================================================== --}}
            <div class="mb-6 grid grid-cols-1 sm:grid-cols-3 gap-4">

                {{-- ID --}}
                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-xl p-5 shadow-sm">

                    <p class="text-xs font-medium uppercase tracking-wide
                              text-gray-500 dark:text-gray-400">
                        Préstamo
                    </p>

                    <p class="mt-1 text-2xl font-bold
                              text-gray-900 dark:text-white">
                        #{{ $prestamo->id }}
                    </p>

                </div>


                {{-- ESTADO --}}
                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-xl p-5 shadow-sm">

                    <p class="text-xs font-medium uppercase tracking-wide
                              text-gray-500 dark:text-gray-400">
                        Estado
                    </p>

                    <p class="mt-2">

                        @if($prestamo->estado === 'activo')

                            <span class="inline-flex items-center px-3 py-1
                                         rounded-full text-xs font-semibold
                                         bg-green-100 text-green-800
                                         dark:bg-green-900/30
                                         dark:text-green-300">
                                ● Activo
                            </span>

                        @elseif($prestamo->estado === 'pagado')

                            <span class="inline-flex items-center px-3 py-1
                                         rounded-full text-xs font-semibold
                                         bg-blue-100 text-blue-800
                                         dark:bg-blue-900/30
                                         dark:text-blue-300">
                                ● Pagado
                            </span>

                        @else

                            <span class="inline-flex items-center px-3 py-1
                                         rounded-full text-xs font-semibold
                                         bg-gray-100 text-gray-700
                                         dark:bg-gray-800
                                         dark:text-gray-300">
                                ● {{ ucfirst($prestamo->estado) }}
                            </span>

                        @endif

                    </p>

                </div>


                {{-- CLIENTE --}}
                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-xl p-5 shadow-sm">

                    <p class="text-xs font-medium uppercase tracking-wide
                              text-gray-500 dark:text-gray-400">
                        Cliente
                    </p>

                    <p class="mt-1 font-bold text-gray-900 dark:text-white truncate">
                        {{ $prestamo->cliente->nombre ?? 'Sin cliente' }}
                    </p>

                    @if($prestamo->cliente)

                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            DNI: {{ $prestamo->cliente->dni }}
                        </p>

                    @endif

                </div>

            </div>


            {{-- ====================================================
                FORMULARIO
            ===================================================== --}}
            <div class="bg-white dark:bg-gray-900
                        border border-gray-200 dark:border-gray-800
                        rounded-2xl shadow-sm overflow-hidden">


                {{-- CABECERA --}}
                <div class="px-6 py-5 border-b border-gray-200
                            dark:border-gray-800">

                    <div class="flex items-center gap-3">

                        <div class="h-11 w-11 rounded-xl
                                    bg-indigo-100 dark:bg-indigo-900/30
                                    flex items-center justify-center
                                    text-xl">

                            ✏️

                        </div>

                        <div>

                            <h3 class="text-lg font-bold
                                       text-gray-900 dark:text-white">
                                Información del préstamo
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Actualiza los datos necesarios.
                            </p>

                        </div>

                    </div>

                </div>


                <form
                    action="{{ route('prestamos.update', $prestamo->id) }}"
                    method="POST"
                    class="p-6 space-y-6"
                >

                    @csrf

                    @method('PUT')


                    {{-- =================================================
                        CLIENTE
                    ================================================== --}}
                    <div>

                        <label for="cliente_id"
                               class="block text-sm font-semibold
                                      text-gray-700 dark:text-gray-300 mb-2">

                            👤 Cliente

                        </label>

                        <select
                            name="cliente_id"
                            id="cliente_id"
                            required
                            class="w-full rounded-lg border-gray-300
                                   dark:border-gray-700
                                   dark:bg-gray-800
                                   dark:text-white
                                   focus:border-indigo-500
                                   focus:ring-indigo-500"
                        >

                            <option value="">
                                Seleccionar cliente
                            </option>

                            @foreach($clientes as $cliente)

                                <option
                                    value="{{ $cliente->id }}"
                                    {{ old('cliente_id', $prestamo->cliente_id) == $cliente->id ? 'selected' : '' }}
                                >

                                    {{ $cliente->nombre }}
                                    — DNI {{ $cliente->dni }}

                                </option>

                            @endforeach

                        </select>

                        @error('cliente_id')

                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        MONTO / INTERÉS
                    ================================================== --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- MONTO --}}
                        <div>

                            <label for="monto"
                                   class="block text-sm font-semibold
                                          text-gray-700 dark:text-gray-300 mb-2">

                                💰 Monto del préstamo

                            </label>

                            <div class="relative">

                                <span class="absolute left-3 top-1/2
                                             -translate-y-1/2
                                             text-gray-500 dark:text-gray-400">
                                    S/
                                </span>

                                <input
                                    type="number"
                                    name="monto"
                                    id="monto"
                                    step="0.01"
                                    min="0.01"
                                    max="100000"
                                    value="{{ old('monto', $prestamo->monto) }}"
                                    required
                                    class="w-full pl-10 rounded-lg
                                           border-gray-300
                                           dark:border-gray-700
                                           dark:bg-gray-800
                                           dark:text-white
                                           focus:border-indigo-500
                                           focus:ring-indigo-500"
                                >

                            </div>

                            @error('monto')

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- INTERÉS --}}
                        <div>

                            <label for="tasa_interes"
                                   class="block text-sm font-semibold
                                          text-gray-700 dark:text-gray-300 mb-2">

                                📈 Tasa de interés

                            </label>

                            <div class="relative">

                                <input
                                    type="number"
                                    name="tasa_interes"
                                    id="tasa_interes"
                                    step="0.01"
                                    min="0"
                                    max="100"
                                    value="{{ old('tasa_interes', $prestamo->tasa_interes) }}"
                                    required
                                    class="w-full pr-10 rounded-lg
                                           border-gray-300
                                           dark:border-gray-700
                                           dark:bg-gray-800
                                           dark:text-white
                                           focus:border-indigo-500
                                           focus:ring-indigo-500"
                                >

                                <span class="absolute right-3 top-1/2
                                             -translate-y-1/2
                                             text-gray-500 dark:text-gray-400">
                                    %
                                </span>

                            </div>

                            @error('tasa_interes')

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- =================================================
                        CUOTAS / FRECUENCIA
                    ================================================== --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- CUOTAS --}}
                        <div>

                            <label for="numero_cuotas"
                                   class="block text-sm font-semibold
                                          text-gray-700 dark:text-gray-300 mb-2">

                                🔢 Número de cuotas

                            </label>

                            <input
                                type="number"
                                name="numero_cuotas"
                                id="numero_cuotas"
                                min="1"
                                max="120"
                                value="{{ old('numero_cuotas', $prestamo->numero_cuotas) }}"
                                required
                                class="w-full rounded-lg
                                       border-gray-300
                                       dark:border-gray-700
                                       dark:bg-gray-800
                                       dark:text-white
                                       focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                            @error('numero_cuotas')

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- FRECUENCIA --}}
                        <div>

                            <label for="frecuencia"
                                   class="block text-sm font-semibold
                                          text-gray-700 dark:text-gray-300 mb-2">

                                🔄 Frecuencia de pago

                            </label>

                            <select
                                name="frecuencia"
                                id="frecuencia"
                                required
                                class="w-full rounded-lg
                                       border-gray-300
                                       dark:border-gray-700
                                       dark:bg-gray-800
                                       dark:text-white
                                       focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                                <option
                                    value="diaria"
                                    {{ old('frecuencia', $prestamo->frecuencia) === 'diaria' ? 'selected' : '' }}
                                >
                                    📅 Diaria
                                </option>

                                <option
                                    value="semanal"
                                    {{ old('frecuencia', $prestamo->frecuencia) === 'semanal' ? 'selected' : '' }}
                                >
                                    📅 Semanal
                                </option>

                                <option
                                    value="quincenal"
                                    {{ old('frecuencia', $prestamo->frecuencia) === 'quincenal' ? 'selected' : '' }}
                                >
                                    📅 Quincenal
                                </option>

                                <option
                                    value="mensual"
                                    {{ old('frecuencia', $prestamo->frecuencia) === 'mensual' ? 'selected' : '' }}
                                >
                                    📅 Mensual
                                </option>

                            </select>

                            @error('frecuencia')

                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>


                    {{-- =================================================
                        FECHA DE INICIO
                    ================================================== --}}
                    <div>

                        <label for="fecha_inicio"
                               class="block text-sm font-semibold
                                      text-gray-700 dark:text-gray-300 mb-2">

                            📅 Fecha de inicio

                        </label>

                        <input
                            type="date"
                            name="fecha_inicio"
                            id="fecha_inicio"
                            value="{{ old('fecha_inicio', optional($prestamo->fecha_inicio)->format('Y-m-d')) }}"
                            required
                            class="w-full rounded-lg
                                   border-gray-300
                                   dark:border-gray-700
                                   dark:bg-gray-800
                                   dark:text-white
                                   focus:border-indigo-500
                                   focus:ring-indigo-500"
                        >

                        @error('fecha_inicio')

                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        AVISO
                    ================================================== --}}
                    <div class="rounded-xl border border-amber-200
                                bg-amber-50 dark:bg-amber-900/20
                                dark:border-amber-800 p-4">

                        <div class="flex gap-3">

                            <span class="text-xl">
                                💡
                            </span>

                            <div>

                                <p class="text-sm font-semibold
                                          text-amber-800 dark:text-amber-300">
                                    Importante
                                </p>

                                <p class="mt-1 text-sm
                                          text-amber-700 dark:text-amber-400">

                                    Si modificas el monto, número de cuotas,
                                    frecuencia o tasa de interés, las cuotas
                                    pendientes pueden ser recalculadas.
                                    Las cuotas que ya hayan sido pagadas
                                    se conservarán.

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        BOTONES
                    ================================================== --}}
                    <div class="flex flex-col-reverse sm:flex-row
                                sm:justify-end gap-3 pt-4
                                border-t border-gray-200
                                dark:border-gray-800">


                        <a
                            href="{{ route('prestamos.show', $prestamo->id) }}"
                            class="inline-flex items-center justify-center
                                   px-5 py-2.5 rounded-lg
                                   border border-gray-300
                                   dark:border-gray-700
                                   bg-white dark:bg-gray-800
                                   text-sm font-semibold
                                   text-gray-700 dark:text-gray-200
                                   hover:bg-gray-50 dark:hover:bg-gray-700
                                   transition"
                        >

                            Cancelar

                        </a>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center
                                   gap-2 px-5 py-2.5 rounded-lg
                                   bg-indigo-600 hover:bg-indigo-700
                                   text-white text-sm font-semibold
                                   shadow-sm transition"
                        >

                            💾 Guardar cambios

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>