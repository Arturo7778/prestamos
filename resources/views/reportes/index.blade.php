<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    📊 Reportes
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Resumen general de la situación financiera del sistema.
                </p>

            </div>


            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center justify-center
                       px-4 py-2
                       rounded-lg
                       bg-gray-700
                       hover:bg-gray-600
                       text-white
                       text-sm
                       font-semibold
                       transition"
            >
                ← Dashboard
            </a>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <!-- RESUMEN GENERAL -->

            <div class="mb-6">

                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                    Resumen general
                </h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Información actual de clientes, préstamos y pagos.
                </p>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


                <!-- CLIENTES -->

                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Clientes
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ $totalClientes }}
                            </p>

                        </div>

                        <div class="h-12 w-12 rounded-xl
                                    bg-blue-100 dark:bg-blue-900/30
                                    flex items-center justify-center text-2xl">
                            👥
                        </div>

                    </div>

                </div>


                <!-- PRÉSTAMOS -->

                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Total de préstamos
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ $totalPrestamos }}
                            </p>

                        </div>

                        <div class="h-12 w-12 rounded-xl
                                    bg-indigo-100 dark:bg-indigo-900/30
                                    flex items-center justify-center text-2xl">
                            💰
                        </div>

                    </div>

                </div>


                <!-- PAGOS -->

                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Pagos registrados
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ $totalPagos }}
                            </p>

                        </div>

                        <div class="h-12 w-12 rounded-xl
                                    bg-green-100 dark:bg-green-900/30
                                    flex items-center justify-center text-2xl">
                            💳
                        </div>

                    </div>

                </div>


                <!-- VENCIDAS -->

                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                Cuotas vencidas
                            </p>

                            <p class="mt-2 text-3xl font-bold
                                {{ $cuotasVencidas > 0
                                    ? 'text-red-500'
                                    : 'text-gray-900 dark:text-white' }}">
                                {{ $cuotasVencidas }}
                            </p>

                        </div>

                        <div class="h-12 w-12 rounded-xl
                                    bg-red-100 dark:bg-red-900/30
                                    flex items-center justify-center text-2xl">
                            ⚠️
                        </div>

                    </div>

                </div>

            </div>


            <!-- RESUMEN FINANCIERO -->

            <div class="mb-6">

                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                    Resumen financiero
                </h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Movimiento general del dinero del sistema.
                </p>

            </div>


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">


                <!-- TOTAL PRESTADO -->

                <div class="bg-gradient-to-br from-indigo-600 to-purple-700
                            rounded-2xl p-6 text-white shadow-lg">

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
                        Capital entregado a clientes.
                    </p>

                </div>


                <!-- TOTAL COBRADO -->

                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Total cobrado
                            </p>

                            <p class="mt-2 text-3xl font-bold text-green-500">
                                S/
                                {{ number_format((float) $totalCobrado, 2) }}
                            </p>

                        </div>

                        <span class="text-3xl">
                            ✅
                        </span>

                    </div>

                    <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                        Dinero recibido mediante pagos.
                    </p>

                </div>


                <!-- SALDO -->

                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl shadow-sm p-6">

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
                        Monto pendiente por recuperar.
                    </p>

                </div>

            </div>


            <!-- ESTADO DE PRÉSTAMOS -->

            <div class="mb-6">

                <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                    Estado de los préstamos
                </h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Distribución actual de los préstamos registrados.
                </p>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">


                <!-- ACTIVOS -->

                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Préstamos activos
                            </p>

                            <p class="mt-2 text-3xl font-bold text-indigo-500">
                                {{ $prestamosActivos }}
                            </p>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Préstamos que todavía tienen saldo pendiente.
                            </p>

                        </div>

                        <span class="text-3xl">
                            🔄
                        </span>

                    </div>

                </div>


                <!-- PAGADOS -->

                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl shadow-sm p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Préstamos pagados
                            </p>

                            <p class="mt-2 text-3xl font-bold text-green-500">
                                {{ $prestamosPagados }}
                            </p>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Préstamos completamente cancelados.
                            </p>

                        </div>

                        <span class="text-3xl">
                            ✅
                        </span>

                    </div>

                </div>

            </div>


            <!-- ACCIONES -->

            <div class="bg-white dark:bg-gray-900
                        border border-gray-200 dark:border-gray-800
                        rounded-2xl shadow-sm p-6">

                <div class="flex flex-col sm:flex-row
                            sm:items-center
                            sm:justify-between
                            gap-4">

                    <div>

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                            Acciones rápidas
                        </h3>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Accede rápidamente a la información relacionada.
                        </p>

                    </div>


                    <div class="flex flex-wrap gap-3">

                        <a
                            href="{{ route('clientes.index') }}"
                            class="inline-flex items-center
                                   px-4 py-2
                                   rounded-lg
                                   bg-blue-600
                                   hover:bg-blue-700
                                   text-white
                                   text-sm
                                   font-semibold
                                   transition"
                        >
                            👥 Clientes
                        </a>


                        <a
                            href="{{ route('prestamos.index') }}"
                            class="inline-flex items-center
                                   px-4 py-2
                                   rounded-lg
                                   bg-indigo-600
                                   hover:bg-indigo-700
                                   text-white
                                   text-sm
                                   font-semibold
                                   transition"
                        >
                            💰 Préstamos
                        </a>


                        <a
                            href="{{ route('pagos.index') }}"
                            class="inline-flex items-center
                                   px-4 py-2
                                   rounded-lg
                                   bg-green-600
                                   hover:bg-green-700
                                   text-white
                                   text-sm
                                   font-semibold
                                   transition"
                        >
                            💳 Pagos
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>