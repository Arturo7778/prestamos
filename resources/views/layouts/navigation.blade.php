<nav x-data="{ open: false }"
    class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow-sm">

    <!-- ============================================================
         BARRA PRINCIPAL
    ============================================================= -->

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- IZQUIERDA -->

            <div class="flex items-center">

                <!-- LOGO -->

                <div class="shrink-0 flex items-center">

                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-2">

                        <x-application-logo
                            class="block h-9 w-auto fill-current text-blue-600 dark:text-blue-400"
                        />

                        <span class="hidden md:block font-bold text-lg text-gray-800 dark:text-white">
                            Sistema de Préstamos
                        </span>

                    </a>

                </div>


                <!-- =================================================
                     MENÚ PRINCIPAL
                ================================================== -->

                <div class="hidden sm:flex sm:items-center sm:ms-8 gap-1">

                    <!-- DASHBOARD -->

                    <x-nav-link
                        :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')"
                    >
                        🏠 Dashboard
                    </x-nav-link>


                    <!-- CLIENTES -->

                    <x-nav-link
                        :href="route('clientes.index')"
                        :active="request()->routeIs('clientes.*')"
                    >
                        👥 Clientes
                    </x-nav-link>


                    <!-- PRÉSTAMOS -->

                    <x-nav-link
                        :href="route('prestamos.index')"
                        :active="request()->routeIs('prestamos.*')"
                    >
                        💰 Préstamos
                    </x-nav-link>


                    <!-- PAGOS -->

                    @if(in_array(Auth::user()->role, ['administrador', 'cobrador']))

                        <x-nav-link
                            :href="route('pagos.index')"
                            :active="request()->routeIs('pagos.*')"
                        >
                            💳 Pagos
                        </x-nav-link>

                    @endif


                    <!-- USUARIOS -->

                    @if(Auth::user()->role === 'administrador')

                        <x-nav-link
                            :href="route('usuarios.index')"
                            :active="request()->routeIs('usuarios.*')"
                        >
                            ⚙️ Usuarios
                        </x-nav-link>

                    @endif

                </div>

            </div>


            <!-- =====================================================
                 PERFIL / USUARIO
            ====================================================== -->

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center px-3 py-2
                                   border border-transparent
                                   text-sm leading-4 font-medium
                                   rounded-md
                                   text-gray-500 dark:text-gray-400
                                   bg-white dark:bg-gray-800
                                   hover:text-gray-700 dark:hover:text-gray-300
                                   focus:outline-none transition"
                        >

                            <div class="text-right">

                                <div class="font-semibold">
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="text-xs text-gray-400">

                                    @if(Auth::user()->role === 'administrador')
                                        Administrador

                                    @elseif(Auth::user()->role === 'cobrador')
                                        Cobrador

                                    @else
                                        Consulta
                                    @endif

                                </div>

                            </div>


                            <div class="ms-2">

                                <svg
                                    class="fill-current h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                >

                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />

                                </svg>

                            </div>

                        </button>

                    </x-slot>


                    <!-- CONTENIDO DEL MENÚ -->

                    <x-slot name="content">

                        <!-- INFORMACIÓN DEL USUARIO -->

                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">

                            <div class="font-semibold text-gray-800 dark:text-gray-200">
                                {{ Auth::user()->name }}
                            </div>

                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->email }}
                            </div>

                        </div>


                        <!-- PERFIL -->

                        <x-dropdown-link :href="route('profile.edit')">
                            👤 Mi perfil
                        </x-dropdown-link>


                        <!-- USUARIOS SOLO ADMIN -->

                        @if(Auth::user()->role === 'administrador')

                            <x-dropdown-link :href="route('usuarios.index')">
                                ⚙️ Gestión de usuarios
                            </x-dropdown-link>

                        @endif


                        <!-- SEPARADOR -->

                        <div class="border-t border-gray-100 dark:border-gray-700"></div>


                        <!-- CERRAR SESIÓN -->

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                🚪 Cerrar sesión
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            <!-- =====================================================
                 BOTÓN MÓVIL
            ====================================================== -->

            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center p-2
                           rounded-md
                           text-gray-400 dark:text-gray-500
                           hover:text-gray-500
                           hover:bg-gray-100
                           dark:hover:bg-gray-900
                           focus:outline-none
                           transition"
                >

                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >

                        <path
                            :class="{'hidden': open, 'inline-flex': ! open}"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <path
                            :class="{'hidden': ! open, 'inline-flex': open}"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />

                    </svg>

                </button>

            </div>

        </div>

    </div>


    <!-- ============================================================
         MENÚ RESPONSIVE
    ============================================================= -->

    <div
        :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden"
    >

        <div class="pt-2 pb-3 space-y-1">

            <!-- DASHBOARD -->

            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
            >
                🏠 Dashboard
            </x-responsive-nav-link>


            <!-- CLIENTES -->

            <x-responsive-nav-link
                :href="route('clientes.index')"
                :active="request()->routeIs('clientes.*')"
            >
                👥 Clientes
            </x-responsive-nav-link>


            <!-- PRÉSTAMOS -->

            <x-responsive-nav-link
                :href="route('prestamos.index')"
                :active="request()->routeIs('prestamos.*')"
            >
                💰 Préstamos
            </x-responsive-nav-link>


            <!-- PAGOS -->

            @if(in_array(Auth::user()->role, ['administrador', 'cobrador']))

                <x-responsive-nav-link
                    :href="route('pagos.index')"
                    :active="request()->routeIs('pagos.*')"
                >
                    💳 Pagos
                </x-responsive-nav-link>

            @endif


            <!-- USUARIOS -->

            @if(Auth::user()->role === 'administrador')

                <x-responsive-nav-link
                    :href="route('usuarios.index')"
                    :active="request()->routeIs('usuarios.*')"
                >
                    ⚙️ Usuarios
                </x-responsive-nav-link>

            @endif

        </div>


        <!-- ========================================================
             DATOS DEL USUARIO
        ========================================================= -->

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">

            <div class="px-4">

                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                    {{ Auth::user()->name }}
                </div>

                <div class="font-medium text-sm text-gray-500 dark:text-gray-400">
                    {{ Auth::user()->email }}
                </div>

                <div class="mt-1 text-xs font-semibold text-blue-600">

                    @if(Auth::user()->role === 'administrador')
                        👑 Administrador

                    @elseif(Auth::user()->role === 'cobrador')
                        💰 Cobrador

                    @else
                        👁️ Consulta
                    @endif

                </div>

            </div>


            <div class="mt-3 space-y-1">

                <!-- PERFIL -->

                <x-responsive-nav-link
                    :href="route('profile.edit')"
                >
                    👤 Mi perfil
                </x-responsive-nav-link>


                <!-- USUARIOS ADMIN -->

                @if(Auth::user()->role === 'administrador')

                    <x-responsive-nav-link
                        :href="route('usuarios.index')"
                    >
                        ⚙️ Gestión de usuarios
                    </x-responsive-nav-link>

                @endif


                <!-- LOGOUT -->

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        🚪 Cerrar sesión
                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

</nav>