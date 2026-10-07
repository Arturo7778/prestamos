<x-app-layout>

    {{-- ============================================================
        ENCABEZADO
    ============================================================= --}}

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    👥 Usuarios
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Administración de usuarios y permisos del sistema
                </p>

            </div>


            {{-- NUEVO USUARIO --}}

            <a href="{{ route('usuarios.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">

                ➕ Nuevo usuario

            </a>

        </div>

    </x-slot>


    {{-- ============================================================
        CONTENIDO
    ============================================================= --}}

    <div class="min-h-screen bg-gray-950 py-10">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            {{-- ====================================================
                MENSAJES
            ===================================================== --}}

            @if(session('success'))

                <div class="mb-6 rounded-xl border border-green-500/30 bg-green-500/10 px-5 py-4 text-green-400">

                    <div class="flex items-center gap-3">

                        <span class="text-xl">✅</span>

                        <span class="font-medium">
                            {{ session('success') }}
                        </span>

                    </div>

                </div>

            @endif


            @if(session('error'))

                <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 px-5 py-4 text-red-400">

                    <div class="flex items-center gap-3">

                        <span class="text-xl">⚠️</span>

                        <span class="font-medium">
                            {{ session('error') }}
                        </span>

                    </div>

                </div>

            @endif


            {{-- ====================================================
                TARJETA PRINCIPAL
            ===================================================== --}}

            <div class="overflow-hidden rounded-2xl border border-gray-800 bg-gray-900 shadow-xl">


                {{-- ENCABEZADO DE TABLA --}}

                <div class="border-b border-gray-800 px-6 py-5">

                    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

                        <div>

                            <h3 class="text-lg font-bold text-white">
                                Usuarios registrados
                            </h3>

                            <p class="mt-1 text-sm text-gray-400">

                                Total:

                                <span class="font-semibold text-indigo-400">
                                    {{ $usuarios->count() }}
                                </span>

                                {{ $usuarios->count() == 1 ? 'usuario' : 'usuarios' }}

                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    TABLA
                ================================================== --}}

                @if($usuarios->count() > 0)

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-800">

                            {{-- CABECERA --}}

                            <thead class="bg-gray-800/70">

                                <tr>

                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-300">
                                        Usuario
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-300">
                                        Correo
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-300">
                                        Rol
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-300">
                                        Registro
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-300">
                                        Acciones
                                    </th>

                                </tr>

                            </thead>


                            {{-- CUERPO --}}

                            <tbody class="divide-y divide-gray-800">

                                @foreach($usuarios as $usuario)

                                    <tr class="transition hover:bg-gray-800/50">


                                        {{-- =================================================
                                            USUARIO
                                        ================================================== --}}

                                        <td class="whitespace-nowrap px-6 py-5">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-600/20 font-bold text-indigo-400">

                                                    {{ strtoupper(substr($usuario->name, 0, 1)) }}

                                                </div>


                                                <div>

                                                    <div class="font-semibold text-white">
                                                        {{ $usuario->name }}
                                                    </div>

                                                    <div class="text-xs text-gray-500">
                                                        ID #{{ $usuario->id }}
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- =================================================
                                            CORREO
                                        ================================================== --}}

                                        <td class="whitespace-nowrap px-6 py-5">

                                            <span class="text-sm text-gray-300">
                                                {{ $usuario->email }}
                                            </span>

                                        </td>


                                        {{-- =================================================
                                            ROL
                                        ================================================== --}}

                                        <td class="whitespace-nowrap px-6 py-5">

                                            @if($usuario->role === 'administrador')

                                                <span class="inline-flex items-center gap-1 rounded-full bg-purple-500/15 px-3 py-1 text-xs font-semibold text-purple-400">

                                                    👑 Administrador

                                                </span>

                                            @elseif($usuario->role === 'cobrador')

                                                <span class="inline-flex items-center gap-1 rounded-full bg-green-500/15 px-3 py-1 text-xs font-semibold text-green-400">

                                                    💰 Cobrador

                                                </span>

                                            @else

                                                <span class="inline-flex items-center gap-1 rounded-full bg-blue-500/15 px-3 py-1 text-xs font-semibold text-blue-400">

                                                    👁️ Consulta

                                                </span>

                                            @endif

                                        </td>


                                        {{-- =================================================
                                            FECHA
                                        ================================================== --}}

                                        <td class="whitespace-nowrap px-6 py-5 text-sm text-gray-400">

                                            {{ $usuario->created_at?->format('d/m/Y') }}

                                        </td>


                                        {{-- =================================================
                                            ACCIONES
                                        ================================================== --}}

                                        <td class="whitespace-nowrap px-6 py-5">

                                            <div class="flex justify-end gap-2">


                                                {{-- =================================================
                                                    VER USUARIO
                                                ================================================== --}}

                                                <a href="{{ route('usuarios.show', $usuario) }}"
                                                   title="Ver usuario"
                                                   class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-gray-800 text-gray-300 transition hover:bg-gray-700 hover:text-white">

                                                    👁️

                                                </a>


                                                {{-- =================================================
                                                    GESTIONAR PERMISOS
                                                ================================================== --}}

                                                <a href="{{ route('usuarios.permisos.edit', $usuario) }}"
                                                   title="Gestionar permisos"
                                                   class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-purple-500/15 text-purple-400 transition hover:bg-purple-500/25">

                                                    🔐

                                                </a>


                                                {{-- =================================================
                                                    EDITAR USUARIO
                                                ================================================== --}}

                                                <a href="{{ route('usuarios.edit', $usuario) }}"
                                                   title="Editar usuario"
                                                   class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-blue-500/15 text-blue-400 transition hover:bg-blue-500/25">

                                                    ✏️

                                                </a>


                                                {{-- =================================================
                                                    ELIMINAR USUARIO
                                                ================================================== --}}

                                                @if($usuario->id !== auth()->id())

                                                    <form method="POST"
                                                          action="{{ route('usuarios.destroy', $usuario) }}"
                                                          onsubmit="return confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.');">

                                                        @csrf

                                                        @method('DELETE')


                                                        <button type="submit"
                                                                title="Eliminar usuario"
                                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-500/15 text-red-400 transition hover:bg-red-500/25">

                                                            🗑️

                                                        </button>

                                                    </form>

                                                @else

                                                    <span title="No puedes eliminar tu propio usuario"
                                                          class="inline-flex h-9 w-9 cursor-not-allowed items-center justify-center rounded-lg bg-gray-800 text-gray-600">

                                                        🔒

                                                    </span>

                                                @endif

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                @else


                    {{-- =================================================
                        SIN USUARIOS
                    ================================================== --}}

                    <div class="px-6 py-20 text-center">


                        <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-indigo-500/10 text-4xl">

                            👥

                        </div>


                        <h3 class="text-lg font-semibold text-white">

                            No hay usuarios registrados

                        </h3>


                        <p class="mx-auto mt-2 max-w-md text-sm text-gray-400">

                            Todavía no existen usuarios adicionales en el sistema.

                            Puedes crear el primero utilizando el botón de arriba.

                        </p>


                        <a href="{{ route('usuarios.create') }}"
                           class="mt-6 inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">

                            ➕ Crear primer usuario

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>