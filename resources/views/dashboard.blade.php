<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Dashboard
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Resumen general del sistema de préstamos
                </p>
            </div>

            <div class="hidden sm:flex items-center gap-3">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{ now()->format('d/m/Y') }}
                </span>

                <div class="h-9 w-9 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </x-slot>


    <div class="min-h-screen bg-gray-100 dark:bg-gray-950">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- BIENVENIDA --}}

            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">
                    ¡Hola, {{ auth()->user()->name }}! 👋
                </h1>

                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Aquí tienes un resumen de la actividad de tu sistema.
                </p>
            </div>


            {{-- TARJETAS PRINCIPALES --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

                {{-- CLIENTES --}}

                <a
                    href="{{ route('clientes.index') }}"
                    class="block bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-5 hover:shadow-md transition-all duration-200"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Clientes
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ $totalClientes }}
                            </p>
                        </div>

                        <div class="h-12 w-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-2xl">
                            👥
                        </div>
                    </div>

                    <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                        Clientes registrados
                    </p>
                </a>


                {{-- PRÉSTAMOS --}}

                <a
                    href="{{ route('prestamos.index') }}"
                    class="block bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-5 hover:shadow-md transition-all duration-200"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Préstamos activos
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ $prestamosActivos }}
                            </p>
                        </div>

                        <div class="h-12 w-12 rounded-xl bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-2xl">
                            💰
                        </div>
                    </div>

                    <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                        Préstamos pendientes
                    </p>
                </a>


                {{-- PAGOS --}}

                <a
                    href="{{ route('pagos.index') }}"
                    class="block bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-5 hover:shadow-md transition-all duration-200"
                >
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Pagos registrados
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ $totalPagos }}
                            </p>
                        </div>

                        <div class="h-12 w-12 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-2xl">
                            💳
                        </div>
                    </div>

                    <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                        Movimientos registrados
                    </p>
                </a>


                {{-- CUOTAS VENCIDAS --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-5">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Cuotas vencidas
                            </p>

                            <p class="mt-2 text-3xl font-bold {{ $cuotasVencidas > 0 ? 'text-red-500' : 'text-gray-900 dark:text-white' }}">
                                {{ $cuotasVencidas }}
                            </p>
                        </div>

                        <div class="h-12 w-12 rounded-xl bg-red-100 dark:bg-red-900/30 flex items-center justify-center text-2xl">
                            ⚠️
                        </div>
                    </div>

                    <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                        @if($cuotasVencidas > 0)
                            Requieren atención
                        @else
                            Todo al día
                        @endif
                    </p>
                </div>

            </div>


            {{-- RESUMEN FINANCIERO --}}

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">

                {{-- TOTAL PRESTADO --}}

                <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-2xl p-6 text-white shadow-lg">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-indigo-100">
                                Total prestado
                            </p>

                            <p class="mt-2 text-3xl font-bold">
                                S/
                                {{ number_format((float) $totalPrestado, 2) }}
                            </p>
                        </div>

                        <span class="text-3xl">
                            💵
                        </span>
                    </div>

                    <p class="mt-4 text-sm text-indigo-100">
                        Capital entregado a clientes
                    </p>
                </div>


                {{-- TOTAL COBRADO --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Total cobrado
                            </p>

                            <p class="mt-2 text-3xl font-bold text-green-600">
                                S/
                                {{ number_format((float) $totalCobrado, 2) }}
                            </p>
                        </div>

                        <span class="text-3xl">
                            ✅
                        </span>
                    </div>

                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                        Pagos recibidos
                    </p>
                </div>


                {{-- SALDO PENDIENTE --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 p-6">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Saldo pendiente
                            </p>

                            <p class="mt-2 text-3xl font-bold text-orange-500">
                                S/
                                {{ number_format((float) $saldoPendiente, 2) }}
                            </p>
                        </div>

                        <span class="text-3xl">
                            📊
                        </span>
                    </div>

                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                        Dinero por recuperar
                    </p>
                </div>

            </div>


            {{-- PARTE INFERIOR --}}

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- PRÓXIMOS VENCIMIENTOS --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800">

                    <div class="p-6 border-b border-gray-200 dark:border-gray-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                    Próximos vencimientos
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Cuotas próximas a vencer
                                </p>
                            </div>

                            <span class="text-2xl">
                                📅
                            </span>
                        </div>
                    </div>


                    <div class="p-6">

                        @if($proximosVencimientos->count() > 0)

                            <div class="space-y-3">

                                @foreach($proximosVencimientos as $cuota)

                                    <div class="flex items-center justify-between gap-4 p-3 rounded-xl bg-gray-50 dark:bg-gray-800/70">

                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-900 dark:text-white truncate">
                                                {{ $cuota->prestamo->cliente->nombre }}
                                            </p>

                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                Préstamo #{{ $cuota->prestamo->id }}
                                                · Cuota #{{ $cuota->numero }}
                                            </p>
                                        </div>

                                        <div class="text-right shrink-0">
                                            <p class="font-semibold text-gray-900 dark:text-white">
                                                S/
                                                {{ number_format((float) $cuota->monto, 2) }}
                                            </p>

                                            <p class="text-xs text-orange-500 mt-1">
                                                {{ $cuota->fecha_vencimiento?->format('d/m/Y') }}
                                            </p>
                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="flex flex-col items-center justify-center py-10 text-center">
                                <div class="text-5xl mb-4">
                                    📅
                                </div>

                                <p class="font-medium text-gray-700 dark:text-gray-300">
                                    No hay vencimientos para mostrar
                                </p>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Aquí aparecerán las próximas cuotas.
                                </p>
                            </div>

                        @endif

                    </div>

                </div>


                {{-- ÚLTIMOS PAGOS --}}

                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800">

                    <div class="p-6 border-b border-gray-200 dark:border-gray-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                    Últimos pagos
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Actividad reciente
                                </p>
                            </div>

                            <span class="text-2xl">
                                💳
                            </span>
                        </div>
                    </div>


                    <div class="p-6">

                        @if($ultimosPagos->count() > 0)

                            <div class="space-y-3">

                                @foreach($ultimosPagos as $pago)

                                    <div class="flex items-center justify-between gap-4 p-3 rounded-xl bg-gray-50 dark:bg-gray-800/70">

                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-900 dark:text-white truncate">
                                                {{ $pago->cuota->prestamo->cliente->nombre }}
                                            </p>

                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                Préstamo #{{ $pago->cuota->prestamo->id }}
                                                · Cuota #{{ $pago->cuota->numero }}
                                                · {{ ucfirst($pago->metodo_pago) }}
                                            </p>
                                        </div>

                                        <div class="text-right shrink-0">
                                            <p class="font-semibold text-green-500">
                                                + S/
                                                {{ number_format((float) $pago->monto, 2) }}
                                            </p>

                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $pago->fecha_pago?->format('d/m/Y') }}
                                            </p>
                                        </div>

                                    </div>

                                @endforeach

                            </div>


                            <div class="mt-4 text-right">
                                <a
                                    href="{{ route('pagos.index') }}"
                                    class="text-sm font-semibold text-blue-500 hover:text-blue-400 transition"
                                >
                                    Ver todos los pagos →
                                </a>
                            </div>

                        @else

                            <div class="flex flex-col items-center justify-center py-10 text-center">

                                <div class="text-5xl mb-4">
                                    💳
                                </div>

                                <p class="font-medium text-gray-700 dark:text-gray-300">
                                    No hay pagos recientes
                                </p>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Los pagos registrados aparecerán aquí.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- ACCESOS RÁPIDOS --}}

            <div class="mt-8">

                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                    Accesos rápidos
                </h3>


                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    {{-- CLIENTES --}}

                    <a
                        href="{{ route('clientes.index') }}"
                        class="group block bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5 shadow-sm hover:border-blue-500 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200"
                    >
                        <div class="text-3xl mb-3">
                            👥
                        </div>

                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            Clientes
                        </h4>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Administrar clientes
                        </p>

                        <p class="mt-4 text-xs font-semibold text-blue-600 dark:text-blue-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            Ir a clientes →
                        </p>
                    </a>


                    {{-- PRÉSTAMOS --}}

                    <a
                        href="{{ route('prestamos.index') }}"
                        class="group block bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5 shadow-sm hover:border-indigo-500 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200"
                    >
                        <div class="text-3xl mb-3">
                            💰
                        </div>

                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            Préstamos
                        </h4>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Gestionar préstamos
                        </p>

                        <p class="mt-4 text-xs font-semibold text-indigo-600 dark:text-indigo-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            Ver préstamos →
                        </p>
                    </a>


                    {{-- PAGOS --}}

                    <a
                        href="{{ route('pagos.index') }}"
                        class="group block bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5 shadow-sm hover:border-purple-500 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200"
                    >
                        <div class="text-3xl mb-3">
                            💳
                        </div>

                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            Pagos
                        </h4>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Consultar pagos
                        </p>

                        <p class="mt-4 text-xs font-semibold text-purple-600 dark:text-purple-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            Ver pagos →
                        </p>
                    </a>


                    {{-- REPORTES --}}

                    <a
                        href="{{ route('reportes.index') }}"
                        class="group block bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl p-5 shadow-sm hover:border-purple-500 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200"
                    >
                        <div class="text-3xl mb-3">
                            📊
                        </div>

                        <h4 class="font-semibold text-gray-900 dark:text-white">
                            Reportes
                        </h4>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Información financiera
                        </p>

                        <p class="mt-4 text-xs font-semibold text-purple-600 dark:text-purple-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            Ver reportes →
                        </p>
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
