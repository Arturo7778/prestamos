<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                ➕ Nuevo usuario
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Crea un nuevo usuario para el sistema
            </p>
        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- ERRORES --}}

            @if($errors->any())

                <div class="mb-6 p-4 rounded-xl
                            bg-red-100 border border-red-200
                            text-red-800">

                    <div class="font-semibold mb-2">
                        ⚠️ Revisa los siguientes errores:
                    </div>

                    <ul class="list-disc list-inside text-sm">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- FORMULARIO --}}

            <div class="bg-white dark:bg-gray-800
                        shadow-sm sm:rounded-xl overflow-hidden">


                {{-- CABECERA --}}

                <div class="p-6 border-b
                            border-gray-200 dark:border-gray-700">

                    <h3 class="text-lg font-semibold
                               text-gray-900 dark:text-white">

                        Información del usuario

                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                        Completa los datos y asigna el rol correspondiente.

                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('usuarios.store') }}"
                    class="p-6 space-y-6"
                >

                    @csrf


                    {{-- NOMBRE --}}

                    <div>

                        <label
                            for="name"
                            class="block text-sm font-semibold
                                   text-gray-700 dark:text-gray-300"
                        >
                            👤 Nombre completo
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            placeholder="Ej. Juan Pérez"
                            class="mt-2 block w-full rounded-lg
                                   border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700
                                   dark:text-white
                                   focus:border-indigo-500
                                   focus:ring-indigo-500"
                        >

                    </div>


                    {{-- CORREO --}}

                    <div>

                        <label
                            for="email"
                            class="block text-sm font-semibold
                                   text-gray-700 dark:text-gray-300"
                        >
                            📧 Correo electrónico
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="usuario@correo.com"
                            class="mt-2 block w-full rounded-lg
                                   border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700
                                   dark:text-white
                                   focus:border-indigo-500
                                   focus:ring-indigo-500"
                        >

                    </div>


                    {{-- ROL --}}

                    <div>

                        <label
                            for="role"
                            class="block text-sm font-semibold
                                   text-gray-700 dark:text-gray-300"
                        >
                            🛡️ Rol del usuario
                        </label>

                        <select
                            name="role"
                            id="role"
                            required
                            class="mt-2 block w-full rounded-lg
                                   border-gray-300 dark:border-gray-600
                                   dark:bg-gray-700
                                   dark:text-white
                                   focus:border-indigo-500
                                   focus:ring-indigo-500"
                        >

                            <option value="">
                                Seleccionar rol
                            </option>

                            <option
                                value="administrador"
                                {{ old('role') === 'administrador' ? 'selected' : '' }}
                            >
                                👑 Administrador
                            </option>

                            <option
                                value="cobrador"
                                {{ old('role') === 'cobrador' ? 'selected' : '' }}
                            >
                                💰 Cobrador
                            </option>

                            <option
                                value="consulta"
                                {{ old('role') === 'consulta' ? 'selected' : '' }}
                            >
                                👁️ Consulta
                            </option>

                        </select>

                    </div>


                    {{-- CONTRASEÑAS --}}

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        <div>

                            <label
                                for="password"
                                class="block text-sm font-semibold
                                       text-gray-700 dark:text-gray-300"
                            >
                                🔒 Contraseña
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                placeholder="Mínimo 8 caracteres"
                                class="mt-2 block w-full rounded-lg
                                       border-gray-300 dark:border-gray-600
                                       dark:bg-gray-700
                                       dark:text-white
                                       focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                        </div>


                        <div>

                            <label
                                for="password_confirmation"
                                class="block text-sm font-semibold
                                       text-gray-700 dark:text-gray-300"
                            >
                                🔒 Confirmar contraseña
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                required
                                placeholder="Repite la contraseña"
                                class="mt-2 block w-full rounded-lg
                                       border-gray-300 dark:border-gray-600
                                       dark:bg-gray-700
                                       dark:text-white
                                       focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                        </div>

                    </div>


                    {{-- INFORMACIÓN DEL ROL --}}

                    <div class="rounded-xl
                                bg-indigo-50 dark:bg-indigo-950/40
                                border border-indigo-100
                                dark:border-indigo-900
                                p-4">

                        <div class="font-semibold
                                    text-indigo-800
                                    dark:text-indigo-300">

                            🛡️ Sobre los roles

                        </div>

                        <div class="mt-3 space-y-2
                                    text-sm
                                    text-indigo-700
                                    dark:text-indigo-300">

                            <p>
                                👑 <strong>Administrador:</strong>
                                acceso completo al sistema.
                            </p>

                            <p>
                                💰 <strong>Cobrador:</strong>
                                podrá gestionar clientes, préstamos y pagos
                                según sus permisos.
                            </p>

                            <p>
                                👁️ <strong>Consulta:</strong>
                                podrá consultar información sin modificarla.
                            </p>

                        </div>

                    </div>


                    {{-- BOTONES --}}

                    <div class="flex flex-col-reverse sm:flex-row
                                sm:justify-end gap-3 pt-4
                                border-t border-gray-200
                                dark:border-gray-700">

                        <a
                            href="{{ route('usuarios.index') }}"
                            class="inline-flex justify-center items-center
                                   px-5 py-2.5 rounded-lg
                                   bg-gray-100 hover:bg-gray-200
                                   dark:bg-gray-700
                                   dark:hover:bg-gray-600
                                   text-gray-700
                                   dark:text-gray-200
                                   font-semibold transition"
                        >
                            ↩️ Cancelar
                        </a>


                        <button
                            type="submit"
                            class="inline-flex justify-center items-center
                                   px-5 py-2.5 rounded-lg
                                   bg-indigo-600 hover:bg-indigo-700
                                   text-white font-semibold
                                   shadow-sm transition"
                        >
                            ✅ Crear usuario
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>