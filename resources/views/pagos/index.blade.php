<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    💳 Historial de Pagos
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Registro de todos los pagos realizados.
                </p>

            </div>

        </div>

    </x-slot>


    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <!-- BUSCADOR -->

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">

                <div class="p-6">

                    <div class="flex items-center gap-2 mb-4">

                        <span class="text-xl">
                            🔎
                        </span>

                        <div>

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                Buscar pagos
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Busca por cliente, DNI, préstamo o número de cuota.
                            </p>

                        </div>

                    </div>


                    <form
                        method="GET"
                        action="{{ route('pagos.index') }}"
                        class="flex flex-col sm:flex-row gap-3"
                    >

                        <div class="flex-1">

                            <label
                                for="buscar"
                                class="sr-only"
                            >
                                Buscar
                            </label>

                            <input
                                type="text"
                                id="buscar"
                                name="buscar"
                                value="{{ $buscar ?? '' }}"
                                placeholder="Cliente, DNI, préstamo o cuota..."
                                class="w-full rounded-lg
                                       border-gray-300 dark:border-gray-600
                                       bg-gray-50 dark:bg-gray-700
                                       text-gray-900 dark:text-gray-100
                                       placeholder-gray-400
                                       focus:border-blue-500
                                       focus:ring-blue-500"
                            >

                        </div>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center
                                   px-5 py-2.5
                                   rounded-lg
                                   bg-blue-600
                                   hover:bg-blue-700
                                   text-white
                                   font-semibold
                                   transition"
                        >
                            🔎 Buscar
                        </button>


                        @if(!empty($buscar))

                            <a
                                href="{{ route('pagos.index') }}"
                                class="inline-flex items-center justify-center
                                       px-5 py-2.5
                                       rounded-lg
                                       bg-gray-600
                                       hover:bg-gray-700
                                       text-white
                                       font-semibold
                                       transition"
                            >
                                ✕ Limpiar
                            </a>

                        @endif

                    </form>

                </div>

            </div>


            <!-- TABLA -->

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <div class="flex items-center justify-between mb-4">

                        <div>

                            <h3 class="text-lg font-semibold">
                                Pagos registrados
                            </h3>


                            @if(!empty($buscar))

                                <p class="text-sm text-gray-400 mt-1">

                                    Resultados para:

                                    <span class="font-semibold text-blue-400">
                                        "{{ $buscar }}"
                                    </span>

                                </p>

                            @endif

                        </div>


                        <div class="text-sm text-gray-400">

                            {{ $pagos->count() }}

                            {{ $pagos->count() === 1 ? 'pago' : 'pagos' }}

                        </div>

                    </div>


                    @if($pagos->count() > 0)

                        <div class="overflow-x-auto">

                            <table class="min-w-full divide-y divide-gray-700">

                                <thead>

                                    <tr class="text-left text-sm text-gray-400">

                                        <th class="px-4 py-3">
                                            Fecha
                                        </th>

                                        <th class="px-4 py-3">
                                            Cliente
                                        </th>

                                        <th class="px-4 py-3">
                                            Préstamo
                                        </th>

                                        <th class="px-4 py-3">
                                            Cuota
                                        </th>

                                        <th class="px-4 py-3">
                                            Monto
                                        </th>

                                        <th class="px-4 py-3">
                                            Método
                                        </th>

                                        <th class="px-4 py-3">
                                            Referencia
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="divide-y divide-gray-700">

                                    @foreach($pagos as $pago)

                                        <tr class="text-sm hover:bg-gray-700/30 transition">

                                            <td class="px-4 py-3">

                                                {{ $pago->fecha_pago?->format('d/m/Y') }}

                                            </td>


                                            <td class="px-4 py-3 font-medium">

                                                {{ $pago->cuota->prestamo->cliente->nombre }}

                                            </td>


                                            <td class="px-4 py-3">

                                                #{{ $pago->cuota->prestamo->id }}

                                            </td>


                                            <td class="px-4 py-3">

                                                #{{ $pago->cuota->numero }}

                                            </td>


                                            <td class="px-4 py-3 font-semibold text-emerald-400">

                                                S/
                                                {{ number_format((float) $pago->monto, 2) }}

                                            </td>


                                            <td class="px-4 py-3 capitalize">

                                                {{ $pago->metodo_pago }}

                                            </td>


                                            <td class="px-4 py-3 text-gray-400">

                                                {{ $pago->referencia_pago ?: '—' }}

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                    @else

                        <div class="py-12 text-center">

                            <div class="text-5xl mb-4">
                                🔎
                            </div>


                            <h3 class="text-lg font-semibold text-gray-200">

                                @if(!empty($buscar))

                                    No encontramos pagos

                                @else

                                    No hay pagos registrados

                                @endif

                            </h3>


                            <p class="text-sm text-gray-400 mt-2">

                                @if(!empty($buscar))

                                    Intenta buscar con otro nombre, DNI, préstamo o cuota.

                                @else

                                    Cuando registres un pago aparecerá aquí.

                                @endif

                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>