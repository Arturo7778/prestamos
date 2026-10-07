<x-guest-layout>

```
<div class="min-h-screen flex items-center justify-center px-4 py-8 bg-slate-950">

    <div class="w-full max-w-5xl grid md:grid-cols-2 bg-slate-900 rounded-3xl overflow-hidden shadow-2xl border border-slate-800">

        {{-- =====================================================
             PANEL IZQUIERDO
        ====================================================== --}}

        <div class="hidden md:flex relative flex-col justify-between p-10 bg-gradient-to-br from-blue-700 via-indigo-700 to-slate-900 text-white overflow-hidden">

            {{-- Decoración --}}
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-indigo-400/20 rounded-full blur-3xl"></div>

            <div class="relative z-10">

                {{-- Logo --}}
                <div class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur flex items-center justify-center text-2xl shadow-lg">
                        🏦
                    </div>

                    <div>
                        <div class="text-xl font-bold tracking-wide">
                            Sistema de Préstamos
                        </div>

                        <div class="text-sm text-blue-100">
                            Gestión financiera
                        </div>
                    </div>

                </div>

            </div>


            <div class="relative z-10">

                <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 border border-white/10 text-xs font-semibold mb-5">
                    🔐 Acceso seguro
                </span>

                <h1 class="text-4xl font-extrabold leading-tight mb-5">
                    Administra tus préstamos
                    <span class="text-blue-200">
                        de forma sencilla.
                    </span>
                </h1>

                <p class="text-blue-100 leading-relaxed max-w-md">
                    Controla clientes, préstamos, cuotas, pagos,
                    vencimientos y movimientos desde un solo lugar.
                </p>

            </div>


            <div class="relative z-10 text-sm text-blue-200">
                © {{ date('Y') }} Sistema de Préstamos
            </div>

        </div>


        {{-- =====================================================
             PANEL DERECHO / LOGIN
        ====================================================== --}}

        <div class="p-6 sm:p-10 lg:p-12 bg-slate-900">

            {{-- Logo móvil --}}
            <div class="md:hidden flex justify-center mb-8">

                <div class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center text-2xl shadow-lg shadow-blue-600/20">
                        🏦
                    </div>

                    <div>
                        <div class="text-lg font-bold text-white">
                            Sistema de Préstamos
                        </div>

                        <div class="text-xs text-slate-400">
                            Gestión financiera
                        </div>
                    </div>

                </div>

            </div>


            {{-- Encabezado --}}

            <div class="mb-8">

                <div class="text-sm font-semibold text-blue-400 mb-2">
                    BIENVENIDO DE NUEVO
                </div>

                <h2 class="text-3xl font-bold text-white">
                    Iniciar sesión
                </h2>

                <p class="mt-2 text-sm text-slate-400">
                    Ingresa tus credenciales para acceder al sistema.
                </p>

            </div>


            {{-- Mensaje de sesión --}}

            <x-auth-session-status
                class="mb-5"
                :status="session('status')"
            />


            {{-- ERRORES GENERALES --}}

            @if ($errors->any())

                <div class="mb-5 rounded-xl border border-red-500/20 bg-red-500/10 p-4">

                    <div class="flex gap-3">

                        <span class="text-red-400">
                            ⚠️
                        </span>

                        <div>

                            <p class="text-sm font-semibold text-red-300">
                                No se pudo iniciar sesión
                            </p>

                            <p class="mt-1 text-xs text-red-400">
                                Revisa tus datos e inténtalo nuevamente.
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =================================================
                 FORMULARIO
            ================================================== --}}

            <form
                method="POST"
                action="{{ route('login') }}"
                x-data="{ mostrarPassword: false }"
            >

                @csrf


                {{-- EMAIL --}}

                <div>

                    <x-input-label
                        for="email"
                        value="Correo electrónico"
                        class="!text-slate-300 !font-semibold"
                    />

                    <div class="relative mt-2">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                            <span class="text-slate-500">
                                ✉️
                            </span>
                        </div>

                        <x-text-input
                            id="email"
                            class="block w-full !pl-11 !rounded-xl !border-slate-700 !bg-slate-950 !text-white placeholder:!text-slate-600 focus:!border-blue-500 focus:!ring-blue-500"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="correo@ejemplo.com"
                        />

                    </div>

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-2"
                    />

                </div>


                {{-- PASSWORD --}}

                <div class="mt-5">

                    <div class="flex items-center justify-between">

                        <x-input-label
                            for="password"
                            value="Contraseña"
                            class="!text-slate-300 !font-semibold"
                        />

                    </div>


                    <div class="relative mt-2">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                            <span class="text-slate-500">
                                🔒
                            </span>
                        </div>


                        <x-text-input
                            id="password"
                            class="block w-full !pl-11 !pr-12 !rounded-xl !border-slate-700 !bg-slate-950 !text-white placeholder:!text-slate-600 focus:!border-blue-500 focus:!ring-blue-500"
                            x-bind:type="mostrarPassword ? 'text' : 'password'"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                        />


                        <button
                            type="button"
                            @click="mostrarPassword = !mostrarPassword"
                            class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-500 hover:text-white transition"
                            :aria-label="mostrarPassword ? 'Ocultar contraseña' : 'Mostrar contraseña'"
                        >

                            <span x-show="!mostrarPassword">
                                👁️
                            </span>

                            <span x-show="mostrarPassword">
                                🙈
                            </span>

                        </button>

                    </div>


                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-2"
                    />

                </div>


                {{-- RECORDAR + RECUPERAR --}}

                <div class="flex items-center justify-between mt-5">

                    <label
                        for="remember_me"
                        class="inline-flex items-center cursor-pointer"
                    >

                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="rounded border-slate-700 bg-slate-950 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-offset-slate-900"
                        >

                        <span class="ms-2 text-sm text-slate-400">
                            Recordarme
                        </span>

                    </label>


                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="text-sm font-medium text-blue-400 hover:text-blue-300 transition"
                        >
                            ¿Olvidaste tu contraseña?
                        </a>

                    @endif

                </div>


                {{-- BOTÓN --}}

                <button
                    type="submit"
                    class="mt-7 w-full inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 hover:bg-blue-500 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition-all duration-200"
                >

                    <span>
                        🔐
                    </span>

                    Iniciar sesión

                </button>


                {{-- REGISTRO --}}

                @if (Route::has('register'))

                    <div class="mt-7 text-center">

                        <span class="text-sm text-slate-500">
                            ¿No tienes una cuenta?
                        </span>

                        <a
                            href="{{ route('register') }}"
                            class="text-sm font-semibold text-blue-400 hover:text-blue-300 transition ml-1"
                        >
                            Crear cuenta
                        </a>

                    </div>

                @endif

            </form>


            {{-- SEGURIDAD --}}

            <div class="mt-8 pt-6 border-t border-slate-800">

                <div class="flex items-center justify-center gap-2 text-xs text-slate-500">

                    <span>
                        🛡️
                    </span>

                    <span>
                        Tu información está protegida
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>
```

</x-guest-layout>
