<x-app-layout>

    {{-- ============================================================
        HEADER
    ============================================================= --}}
    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Clientes
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Administración de clientes registrados
                </p>
            </div>

            <a href="{{ route('clientes.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">

                ➕ Nuevo cliente

            </a>

        </div>

    </x-slot>


    {{-- ============================================================
        CONTENIDO
    ============================================================= --}}
    <div class="min-h-screen bg-gray-100 dark:bg-gray-950">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- MENSAJE DE ÉXITO --}}
            @if(session('success'))

                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 dark:bg-green-900/20 dark:border-green-800 p-4">

                    <div class="flex items-center gap-3">

                        <span class="text-xl">
                            ✅
                        </span>

                        <p class="text-sm font-medium text-green-800 dark:text-green-300">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- TARJETA PRINCIPAL --}}
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">


                {{-- CABECERA --}}
                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <div class="flex items-center justify-between">

                        <div>

                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                Lista de clientes
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ $clientes->count() }}
                                {{ $clientes->count() == 1 ? 'cliente registrado' : 'clientes registrados' }}
                            </p>

                        </div>

                        <div class="text-3xl">
                            👥
                        </div>

                    </div>

                </div>


                {{-- TABLA --}}
                <div class="overflow-x-auto">

                    <table class="w-full text-sm text-left">

                        <thead class="bg-gray-50 dark:bg-gray-800/70">

                            <tr>

                                <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">
                                    ID
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">
                                    DNI
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">
                                    Cliente
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">
                                    Teléfono
                                </th>

                                <th class="px-6 py-4 font-semibold text-gray-600 dark:text-gray-300">
                                    Correo
                                </th>

                                <th class="px-6 py-4 text-right font-semibold text-gray-600 dark:text-gray-300">
                                    Acciones
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">

                            @forelse($clientes as $cliente)

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition">


                                    {{-- ID --}}
                                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                                        #{{ $cliente->id }}
                                    </td>


                                    {{-- DNI --}}
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $cliente->dni }}
                                    </td>


                                    {{-- NOMBRE --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="h-9 w-9 rounded-full bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold">

                                                {{ strtoupper(substr($cliente->nombre, 0, 1)) }}

                                            </div>

                                            <div>

                                                <p class="font-semibold text-gray-900 dark:text-white">
                                                    {{ $cliente->nombre }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- TELÉFONO --}}
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                        {{ $cliente->telefono ?: '—' }}
                                    </td>


                                    {{-- CORREO --}}
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                        {{ $cliente->correo ?: '—' }}
                                    </td>


                                    {{-- ACCIONES --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center justify-end gap-2">


                                            {{-- VER --}}
                                            <a href="{{ route('clientes.show', $cliente->id) }}"
                                               class="inline-flex items-center px-3 py-2 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-900/50 transition"
                                               title="Ver cliente">

                                                👁️

                                            </a>


                                            {{-- EDITAR --}}
                                            <a href="{{ route('clientes.edit', $cliente->id) }}"
                                               class="inline-flex items-center px-3 py-2 rounded-lg bg-yellow-50 text-yellow-700 hover:bg-yellow-100 dark:bg-yellow-900/30 dark:text-yellow-300 dark:hover:bg-yellow-900/50 transition"
                                               title="Editar cliente">

                                                ✏️

                                            </a>


                                            {{-- ELIMINAR --}}
                                            <form method="POST"
                                                  action="{{ route('clientes.destroy', $cliente->id) }}"
                                                  onsubmit="return confirm('¿Seguro que deseas eliminar este cliente?');">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-2 rounded-lg bg-red-50 text-red-700 hover:bg-red-100 dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50 transition"
                                                        title="Eliminar cliente">

                                                    🗑️

                                                </button>

                                            </form>


                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-16 text-center">

                                        <div class="text-6xl mb-4">
                                            👥
                                        </div>

                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            No hay clientes registrados
                                        </h3>

                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            Comienza registrando tu primer cliente.
                                        </p>

                                        <a href="{{ route('clientes.create') }}"
                                           class="inline-flex items-center gap-2 mt-5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">

                                            ➕ Registrar cliente

                                        </a>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>