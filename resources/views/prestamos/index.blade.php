<x-app-layout>

    {{-- ============================================================
        HEADER
    ============================================================= --}}
    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Préstamos
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Administración y seguimiento de préstamos
                </p>

            </div>


            <a href="{{ route('prestamos.create') }}"
               class="inline-flex items-center justify-center gap-2
                      px-4 py-2.5 rounded-lg
                      bg-indigo-600 hover:bg-indigo-700
                      text-white text-sm font-semibold
                      shadow-sm transition">

                ➕ Nuevo préstamo

            </a>

        </div>

    </x-slot>


    {{-- ============================================================
        CONTENIDO
    ============================================================= --}}
    <div class="min-h-screen bg-gray-100 dark:bg-gray-950">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ====================================================
                MENSAJE DE ÉXITO
            ===================================================== --}}
            @if(session('success'))

                <div class="mb-6 rounded-xl border border-green-200
                            bg-green-50 dark:bg-green-900/20
                            dark:border-green-800 p-4">

                    <div class="flex items-center gap-3">

                        <span class="text-xl">
                            ✅
                        </span>

                        <p class="text-sm font-medium
                                  text-green-800 dark:text-green-300">

                            {{ session('success') }}

                        </p>

                    </div>

                </div>

            @endif


            {{-- ====================================================
                TARJETAS RESUMEN
            ===================================================== --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">


                {{-- TOTAL --}}
                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Total préstamos
                            </p>

                            <p class="mt-1 text-2xl font-bold
                                      text-gray-900 dark:text-white">

                                {{ $prestamos->count() }}

                            </p>

                        </div>

                        <div class="h-11 w-11 rounded-xl
                                    bg-indigo-100 dark:bg-indigo-900/30
                                    flex items-center justify-center text-xl">

                            🏦

                        </div>

                    </div>

                </div>


                {{-- ACTIVOS --}}
                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Activos
                            </p>

                            <p class="mt-1 text-2xl font-bold
                                      text-green-600 dark:text-green-400">

                                {{ $prestamos->where('estado', 'activo')->count() }}

                            </p>

                        </div>

                        <div class="h-11 w-11 rounded-xl
                                    bg-green-100 dark:bg-green-900/30
                                    flex items-center justify-center text-xl">

                            📈

                        </div>

                    </div>

                </div>


                {{-- PAGADOS --}}
                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Pagados
                            </p>

                            <p class="mt-1 text-2xl font-bold
                                      text-blue-600 dark:text-blue-400">

                                {{ $prestamos->where('estado', 'pagado')->count() }}

                            </p>

                        </div>

                        <div class="h-11 w-11 rounded-xl
                                    bg-blue-100 dark:bg-blue-900/30
                                    flex items-center justify-center text-xl">

                            ✅

                        </div>

                    </div>

                </div>


                {{-- CAPITAL --}}
                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Capital colocado
                            </p>

                            <p class="mt-1 text-2xl font-bold
                                      text-gray-900 dark:text-white">

                                S/ {{ number_format($prestamos->sum('monto'), 2) }}

                            </p>

                        </div>

                        <div class="h-11 w-11 rounded-xl
                                    bg-yellow-100 dark:bg-yellow-900/30
                                    flex items-center justify-center text-xl">

                            💰

                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                TABLA
            ===================================================== --}}
            <div class="bg-white dark:bg-gray-900
                        rounded-2xl shadow-sm
                        border border-gray-200 dark:border-gray-800
                        overflow-hidden">


                {{-- CABECERA --}}
                <div class="px-6 py-5
                            border-b border-gray-200 dark:border-gray-800">

                    <div class="flex flex-col sm:flex-row
                                sm:items-center sm:justify-between gap-3">

                        <div>

                            <h3 class="text-lg font-bold
                                       text-gray-900 dark:text-white">

                                Lista de préstamos

                            </h3>

                            <p class="mt-1 text-sm
                                      text-gray-500 dark:text-gray-400">

                                {{ $prestamos->count() }}
                                {{ $prestamos->count() == 1
                                    ? 'préstamo registrado'
                                    : 'préstamos registrados' }}

                            </p>

                        </div>

                        <div class="text-3xl">
                            💰
                        </div>

                    </div>

                </div>


                {{-- =================================================
                    TABLA
                ================================================== --}}
                @if($prestamos->count() > 0)

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm text-left">


                            {{-- CABECERA --}}
                            <thead class="bg-gray-50 dark:bg-gray-800/70">

                                <tr>

                                    <th class="px-6 py-4 font-semibold
                                               text-gray-600 dark:text-gray-300">
                                        ID
                                    </th>

                                    <th class="px-6 py-4 font-semibold
                                               text-gray-600 dark:text-gray-300">
                                        Cliente
                                    </th>

                                    <th class="px-6 py-4 font-semibold
                                               text-gray-600 dark:text-gray-300">
                                        Monto
                                    </th>

                                    <th class="px-6 py-4 font-semibold
                                               text-gray-600 dark:text-gray-300">
                                        Interés
                                    </th>

                                    <th class="px-6 py-4 font-semibold
                                               text-gray-600 dark:text-gray-300">
                                        Cuotas
                                    </th>

                                    <th class="px-6 py-4 font-semibold
                                               text-gray-600 dark:text-gray-300">
                                        Frecuencia
                                    </th>

                                    <th class="px-6 py-4 font-semibold
                                               text-gray-600 dark:text-gray-300">
                                        Estado
                                    </th>

                                    <th class="px-6 py-4 text-right
                                               font-semibold
                                               text-gray-600 dark:text-gray-300">
                                        Acciones
                                    </th>

                                </tr>

                            </thead>


                            {{-- CUERPO --}}
                            <tbody class="divide-y
                                         divide-gray-200
                                         dark:divide-gray-800">


                                @foreach($prestamos as $prestamo)

                                    <tr class="hover:bg-gray-50
                                               dark:hover:bg-gray-800/50
                                               transition">


                                        {{-- ID --}}
                                        <td class="px-6 py-4">

                                            <span class="font-semibold
                                                         text-gray-700
                                                         dark:text-gray-300">

                                                #{{ $prestamo->id }}

                                            </span>

                                        </td>


                                        {{-- CLIENTE --}}
                                        <td class="px-6 py-4">

                                            <div class="flex items-center gap-3">

                                                <div class="h-9 w-9 rounded-full
                                                            bg-indigo-100
                                                            dark:bg-indigo-900/40
                                                            flex items-center
                                                            justify-center
                                                            text-indigo-600
                                                            dark:text-indigo-400
                                                            font-bold">

                                                    {{ strtoupper(
                                                        substr(
                                                            $prestamo->cliente->nombre ?? '?',
                                                            0,
                                                            1
                                                        )
                                                    ) }}

                                                </div>

                                                <div>

                                                    <p class="font-semibold
                                                              text-gray-900
                                                              dark:text-white">

                                                        {{ $prestamo->cliente->nombre ?? 'Sin cliente' }}

                                                    </p>

                                                    <p class="text-xs
                                                              text-gray-500
                                                              dark:text-gray-400">

                                                        DNI:
                                                        {{ $prestamo->cliente->dni ?? '—' }}

                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- MONTO --}}
                                        <td class="px-6 py-4">

                                            <span class="font-bold
                                                         text-gray-900
                                                         dark:text-white">

                                                S/ {{ number_format($prestamo->monto, 2) }}

                                            </span>

                                        </td>


                                        {{-- INTERÉS --}}
                                        <td class="px-6 py-4
                                                   text-gray-600
                                                   dark:text-gray-300">

                                            {{ number_format($prestamo->tasa_interes, 2) }}%

                                        </td>


                                        {{-- CUOTAS --}}
                                        <td class="px-6 py-4">

                                            <span class="font-medium
                                                         text-gray-900
                                                         dark:text-white">

                                                {{ $prestamo->numero_cuotas }}

                                            </span>

                                        </td>


                                        {{-- FRECUENCIA --}}
                                        <td class="px-6 py-4
                                                   text-gray-600
                                                   dark:text-gray-300">

                                            {{ ucfirst($prestamo->frecuencia) }}

                                        </td>


                                        {{-- ESTADO --}}
                                        <td class="px-6 py-4">

                                            @if($prestamo->estado === 'pagado')

                                                <span class="inline-flex items-center
                                                             gap-1 px-3 py-1
                                                             rounded-full text-xs
                                                             font-semibold
                                                             bg-blue-100
                                                             text-blue-800
                                                             dark:bg-blue-900/30
                                                             dark:text-blue-300">

                                                    ✓ Pagado

                                                </span>

                                            @elseif($prestamo->estado === 'vencido')

                                                <span class="inline-flex items-center
                                                             gap-1 px-3 py-1
                                                             rounded-full text-xs
                                                             font-semibold
                                                             bg-red-100
                                                             text-red-800
                                                             dark:bg-red-900/30
                                                             dark:text-red-300">

                                                    ⚠ Vencido

                                                </span>

                                            @elseif($prestamo->estado === 'activo')

                                                <span class="inline-flex items-center
                                                             gap-1 px-3 py-1
                                                             rounded-full text-xs
                                                             font-semibold
                                                             bg-green-100
                                                             text-green-800
                                                             dark:bg-green-900/30
                                                             dark:text-green-300">

                                                    ● Activo

                                                </span>

                                            @else

                                                <span class="inline-flex items-center
                                                             gap-1 px-3 py-1
                                                             rounded-full text-xs
                                                             font-semibold
                                                             bg-gray-100
                                                             text-gray-700
                                                             dark:bg-gray-800
                                                             dark:text-gray-300">

                                                    {{ ucfirst($prestamo->estado) }}

                                                </span>

                                            @endif

                                        </td>


                                        {{-- ACCIONES --}}
                                        <td class="px-6 py-4">

                                            <div class="flex items-center
                                                        justify-end gap-2">


                                                {{-- VER --}}
                                                <a
                                                    href="{{ route('prestamos.show', $prestamo->id) }}"
                                                    title="Ver préstamo"
                                                    class="inline-flex items-center
                                                           justify-center
                                                           h-9 w-9 rounded-lg
                                                           bg-blue-50
                                                           text-blue-700
                                                           hover:bg-blue-100
                                                           dark:bg-blue-900/30
                                                           dark:text-blue-300
                                                           dark:hover:bg-blue-900/50
                                                           transition"
                                                >

                                                    👁️

                                                </a>


                                                {{-- EDITAR --}}
                                                <a
                                                    href="{{ route('prestamos.edit', $prestamo->id) }}"
                                                    title="Editar préstamo"
                                                    class="inline-flex items-center
                                                           justify-center
                                                           h-9 w-9 rounded-lg
                                                           bg-yellow-50
                                                           text-yellow-700
                                                           hover:bg-yellow-100
                                                           dark:bg-yellow-900/30
                                                           dark:text-yellow-300
                                                           dark:hover:bg-yellow-900/50
                                                           transition"
                                                >

                                                    ✏️

                                                </a>


                                                {{-- ELIMINAR --}}
                                                <form
                                                    action="{{ route('prestamos.destroy', $prestamo->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('⚠️ ¿Seguro que deseas eliminar este préstamo y todas sus cuotas?');"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        title="Eliminar préstamo"
                                                        class="inline-flex items-center
                                                               justify-center
                                                               h-9 w-9 rounded-lg
                                                               bg-red-50
                                                               text-red-700
                                                               hover:bg-red-100
                                                               dark:bg-red-900/30
                                                               dark:text-red-300
                                                               dark:hover:bg-red-900/50
                                                               transition"
                                                    >

                                                        🗑️

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else


                    {{-- =================================================
                        SIN PRÉSTAMOS
                    ================================================== --}}
                    <div class="px-6 py-16 text-center">

                        <div class="text-6xl mb-5">
                            📭
                        </div>

                        <h3 class="text-lg font-bold
                                   text-gray-900 dark:text-white">

                            No hay préstamos registrados

                        </h3>

                        <p class="mt-2 text-sm
                                  text-gray-500 dark:text-gray-400">

                            Todavía no se ha registrado ningún préstamo.

                        </p>


                        <a
                            href="{{ route('prestamos.create') }}"
                            class="inline-flex items-center gap-2
                                   mt-6 px-5 py-2.5
                                   rounded-lg
                                   bg-indigo-600
                                   hover:bg-indigo-700
                                   text-white text-sm
                                   font-semibold
                                   transition"
                        >

                            ➕ Registrar primer préstamo

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>