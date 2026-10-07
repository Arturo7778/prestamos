<x-app-layout>

    {{-- ============================================================
        ENCABEZADO
    ============================================================= --}}

    <x-slot name="header">

        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    🔐 Permisos del usuario
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Administra los accesos individuales de este usuario.
                </p>

            </div>

            <a href="{{ route('usuarios.index') }}"
               class="inline-flex items-center justify-center gap-2 rounded-lg bg-gray-700 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-600">

                ← Volver a usuarios

            </a>

        </div>

    </x-slot>


    {{-- ============================================================
        CONTENIDO
    ============================================================= --}}

    <div class="min-h-screen bg-gray-950 py-10">

        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">


            {{-- ====================================================
                INFORMACIÓN DEL USUARIO
            ===================================================== --}}

            <div class="mb-6 overflow-hidden rounded-2xl border border-gray-800 bg-gray-900 shadow-xl">

                <div class="flex flex-col gap-4 p-6 sm:flex-row sm:items-center">

                    {{-- Avatar --}}

                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-indigo-600/20 text-2xl font-bold text-indigo-400">

                        {{ strtoupper(substr($usuario->name, 0, 1)) }}

                    </div>


                    {{-- Datos --}}

                    <div class="flex-1">

                        <h3 class="text-xl font-bold text-white">
                            {{ $usuario->name }}
                        </h3>

                        <p class="mt-1 text-sm text-gray-400">
                            {{ $usuario->email }}
                        </p>

                    </div>


                    {{-- Rol --}}

                    <div>

                        @if($usuario->role === 'administrador')

                            <span class="inline-flex items-center gap-2 rounded-full bg-purple-500/15 px-4 py-2 text-sm font-semibold text-purple-400">
                                👑 Administrador
                            </span>

                        @elseif($usuario->role === 'cobrador')

                            <span class="inline-flex items-center gap-2 rounded-full bg-green-500/15 px-4 py-2 text-sm font-semibold text-green-400">
                                💰 Cobrador
                            </span>

                        @else

                            <span class="inline-flex items-center gap-2 rounded-full bg-blue-500/15 px-4 py-2 text-sm font-semibold text-blue-400">
                                👁️ Consulta
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- ====================================================
                MENSAJE ADMINISTRADOR
            ===================================================== --}}

            @if($usuario->esAdministrador())

                <div class="mb-6 rounded-xl border border-purple-500/30 bg-purple-500/10 p-5">

                    <div class="flex gap-3">

                        <span class="text-xl">
                            👑
                        </span>

                        <div>

                            <p class="font-semibold text-purple-300">
                                Usuario administrador
                            </p>

                            <p class="mt-1 text-sm text-purple-400">
                                Los administradores tienen acceso completo al sistema
                                independientemente de los permisos seleccionados.
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ====================================================
                FORMULARIO
            ===================================================== --}}

            <form method="POST"
                   action="{{ route('usuarios.permisos.update', $usuario) }}">
                @csrf

                @method('PUT')


                {{-- =================================================
                    TARJETA DE PERMISOS
                ================================================== --}}

                <div class="overflow-hidden rounded-2xl border border-gray-800 bg-gray-900 shadow-xl">


                    {{-- Encabezado --}}

                    <div class="border-b border-gray-800 px-6 py-5">

                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <h3 class="text-lg font-bold text-white">
                                    Permisos del sistema
                                </h3>

                                <p class="mt-1 text-sm text-gray-400">
                                    Selecciona las acciones que este usuario podrá realizar.
                                </p>

                            </div>

                            <div class="rounded-lg bg-indigo-500/10 px-3 py-2 text-sm font-semibold text-indigo-400">

                                {{ count($permisosUsuario) }} asignados

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        PERMISOS AGRUPADOS
                    ================================================== --}}

                    <div class="divide-y divide-gray-800">

                        @forelse($permisos as $modulo => $listaPermisos)

                            <div class="p-6">


                                {{-- Nombre del módulo --}}

                                <div class="mb-5 flex items-center gap-3">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-500/10 text-lg">
                                        📁
                                    </div>

                                    <div>

                                        <h4 class="font-bold text-white">
                                            {{ $modulo }}
                                        </h4>

                                        <p class="text-xs text-gray-500">
                                            Permisos disponibles
                                        </p>

                                    </div>

                                </div>


                                {{-- Permisos --}}

                                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">

                                    @foreach($listaPermisos as $permiso)

                                        @php
                                            $seleccionado = in_array(
                                                $permiso->id,
                                                $permisosUsuario
                                            );
                                        @endphp


                                        <label class="group cursor-pointer">

                                            <div class="flex items-center gap-3 rounded-xl border border-gray-800 bg-gray-950 p-4 transition hover:border-indigo-500/50 hover:bg-gray-800/70">


                                                {{-- Checkbox --}}

                                                <input
                                                    type="checkbox"
                                                    name="permisos[]"
                                                    value="{{ $permiso->id }}"
                                                    {{ $seleccionado ? 'checked' : '' }}
                                                    class="h-5 w-5 rounded border-gray-600 bg-gray-800 text-indigo-600 focus:ring-2 focus:ring-indigo-500"
                                                >


                                                {{-- Información --}}

                                                <div class="min-w-0">

                                                    <p class="font-semibold text-gray-200 group-hover:text-white">

                                                        {{ $permiso->descripcion }}

                                                    </p>

                                                    <p class="mt-1 truncate text-xs text-gray-500">

                                                        {{ $permiso->nombre }}

                                                    </p>

                                                </div>

                                            </div>

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                        @empty

                            <div class="px-6 py-16 text-center">

                                <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-gray-800 text-3xl">
                                    🔐
                                </div>

                                <h3 class="font-semibold text-white">
                                    No hay permisos registrados
                                </h3>

                                <p class="mt-2 text-sm text-gray-500">
                                    Ejecuta el PermissionSeeder para crear los permisos iniciales.
                                </p>

                            </div>

                        @endforelse

                    </div>


                    {{-- =================================================
                        BOTONES
                    ================================================== --}}

                    <div class="flex flex-col-reverse gap-3 border-t border-gray-800 bg-gray-950/50 p-6 sm:flex-row sm:justify-end">

                        <a href="{{ route('usuarios.index') }}"
                           class="inline-flex items-center justify-center rounded-lg border border-gray-700 px-5 py-2.5 text-sm font-semibold text-gray-300 transition hover:bg-gray-800 hover:text-white">

                            Cancelar

                        </a>


                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">

                            💾 Guardar permisos

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>