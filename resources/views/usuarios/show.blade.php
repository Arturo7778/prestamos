<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    👤 Detalle del usuario
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Información del usuario y configuración de acceso.
                </p>

            </div>


            <div class="flex gap-2">

                <a
                    href="{{ route('usuarios.index') }}"
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
                    ← Volver
                </a>


                <a
                    href="{{ route('usuarios.edit', $usuario) }}"
                    class="inline-flex items-center justify-center
                           px-4 py-2
                           rounded-lg
                           bg-indigo-600
                           hover:bg-indigo-700
                           text-white
                           text-sm
                           font-semibold
                           transition"
                >
                    ✏️ Editar
                </a>

            </div>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">


            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


                <!-- PERFIL -->

                <div class="bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl
                            shadow-sm
                            overflow-hidden">

                    <div class="p-6 text-center">

                        <div class="mx-auto h-24 w-24 rounded-full
                                    bg-indigo-600/20
                                    flex items-center justify-center
                                    text-3xl font-bold
                                    text-indigo-400">

                            {{ strtoupper(substr($usuario->name, 0, 1)) }}

                        </div>


                        <h3 class="mt-5 text-xl font-bold
                                   text-gray-900 dark:text-white">

                            {{ $usuario->name }}

                        </h3>


                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                            ID #{{ $usuario->id }}

                        </p>


                        <div class="mt-4">

                            @if($usuario->role === 'administrador')

                                <span class="inline-flex items-center gap-1
                                             rounded-full
                                             bg-purple-500/15
                                             px-4 py-1.5
                                             text-sm font-semibold
                                             text-purple-400">

                                    👑 Administrador

                                </span>

                            @elseif($usuario->role === 'cobrador')

                                <span class="inline-flex items-center gap-1
                                             rounded-full
                                             bg-green-500/15
                                             px-4 py-1.5
                                             text-sm font-semibold
                                             text-green-400">

                                    💰 Cobrador

                                </span>

                            @else

                                <span class="inline-flex items-center gap-1
                                             rounded-full
                                             bg-blue-500/15
                                             px-4 py-1.5
                                             text-sm font-semibold
                                             text-blue-400">

                                    👁️ Consulta

                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                <!-- INFORMACIÓN -->

                <div class="lg:col-span-2
                            bg-white dark:bg-gray-900
                            border border-gray-200 dark:border-gray-800
                            rounded-2xl
                            shadow-sm
                            overflow-hidden">


                    <div class="p-6 border-b
                                border-gray-200 dark:border-gray-800">

                        <h3 class="text-lg font-bold
                                   text-gray-900 dark:text-white">

                            Información del usuario

                        </h3>

                    </div>


                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                            <div>

                                <p class="text-xs uppercase tracking-wide
                                          font-semibold
                                          text-gray-500 dark:text-gray-500">

                                    Nombre

                                </p>

                                <p class="mt-1 text-base font-medium
                                          text-gray-900 dark:text-gray-200">

                                    {{ $usuario->name }}

                                </p>

                            </div>


                            <div>

                                <p class="text-xs uppercase tracking-wide
                                          font-semibold
                                          text-gray-500 dark:text-gray-500">

                                    Correo electrónico

                                </p>

                                <p class="mt-1 text-base font-medium
                                          text-gray-900 dark:text-gray-200">

                                    {{ $usuario->email }}

                                </p>

                            </div>


                            <div>

                                <p class="text-xs uppercase tracking-wide
                                          font-semibold
                                          text-gray-500 dark:text-gray-500">

                                    Rol

                                </p>

                                <p class="mt-1 text-base font-medium
                                          text-gray-900 dark:text-gray-200">

                                    @if($usuario->role === 'administrador')
                                        Administrador
                                    @elseif($usuario->role === 'cobrador')
                                        Cobrador
                                    @else
                                        Consulta
                                    @endif

                                </p>

                            </div>


                            <div>

                                <p class="text-xs uppercase tracking-wide
                                          font-semibold
                                          text-gray-500 dark:text-gray-500">

                                    Fecha de registro

                                </p>

                                <p class="mt-1 text-base font-medium
                                          text-gray-900 dark:text-gray-200">

                                    {{ $usuario->created_at?->format('d/m/Y H:i') }}

                                </p>

                            </div>


                            <div>

                                <p class="text-xs uppercase tracking-wide
                                          font-semibold
                                          text-gray-500 dark:text-gray-500">

                                    Última actualización

                                </p>

                                <p class="mt-1 text-base font-medium
                                          text-gray-900 dark:text-gray-200">

                                    {{ $usuario->updated_at?->format('d/m/Y H:i') }}

                                </p>

                            </div>


                            <div>

                                <p class="text-xs uppercase tracking-wide
                                          font-semibold
                                          text-gray-500 dark:text-gray-500">

                                    Estado

                                </p>

                                <p class="mt-1">

                                    <span class="inline-flex items-center gap-2
                                                 text-sm font-semibold
                                                 text-green-400">

                                        <span class="h-2 w-2 rounded-full bg-green-500"></span>

                                        Activo

                                    </span>

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


            </div>


            <!-- PERMISOS -->

            <div class="mt-6
                        bg-white dark:bg-gray-900
                        border border-gray-200 dark:border-gray-800
                        rounded-2xl
                        shadow-sm
                        overflow-hidden">

                <div class="p-6">

                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-4">

                        <div>

                            <h3 class="text-lg font-bold
                                       text-gray-900 dark:text-white">

                                🔐 Permisos

                            </h3>

                            <p class="mt-1 text-sm
                                      text-gray-500 dark:text-gray-400">

                                Administra los permisos específicos de este usuario.

                            </p>

                        </div>


                        @if($usuario->role === 'administrador')

                            <span class="inline-flex items-center
                                         rounded-full
                                         bg-purple-500/15
                                         px-4 py-2
                                         text-sm font-semibold
                                         text-purple-400">

                                👑 Acceso completo

                            </span>

                        @else

                            <a
                                href="{{ route('usuarios.permisos.edit', $usuario) }}"
                                class="inline-flex items-center justify-center
                                       px-4 py-2
                                       rounded-lg
                                       bg-indigo-600
                                       hover:bg-indigo-700
                                       text-white
                                       text-sm
                                       font-semibold
                                       transition"
                            >
                                🔐 Gestionar permisos
                            </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>