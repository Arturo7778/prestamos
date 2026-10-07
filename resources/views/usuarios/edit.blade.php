<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    ✏️ Editar usuario
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Modifica la información y permisos básicos del usuario.
                </p>

            </div>


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

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">


            @if($errors->any())

                <div class="mb-6 rounded-lg
                            bg-red-500/10
                            border border-red-500/30
                            p-4">

                    <p class="font-semibold text-red-400 mb-2">
                        ⚠️ Revisa los siguientes errores:
                    </p>

                    <ul class="list-disc list-inside text-sm text-red-300">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="bg-white dark:bg-gray-900
                        border border-gray-200 dark:border-gray-800
                        shadow-sm rounded-2xl
                        overflow-hidden">


                <div class="p-6 border-b border-gray-200 dark:border-gray-800">

                    <div class="flex items-center gap-4">

                        <div class="h-14 w-14 rounded-full
                                    bg-indigo-600/20
                                    flex items-center justify-center
                                    text-xl font-bold
                                    text-indigo-400">

                            {{ strtoupper(substr($usuario->name, 0, 1)) }}

                        </div>


                        <div>

                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">

                                {{ $usuario->name }}

                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">

                                ID #{{ $usuario->id }}

                            </p>

                        </div>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('usuarios.update', $usuario) }}"
                    class="p-6 space-y-6"
                >

                    @csrf

                    @method('PUT')


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        <div>

                            <label
                                for="name"
                                class="block text-sm font-semibold
                                       text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Nombre
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $usuario->name) }}"
                                required
                                maxlength="255"
                                class="w-full rounded-lg
                                       border-gray-300 dark:border-gray-700
                                       bg-gray-50 dark:bg-gray-800
                                       text-gray-900 dark:text-white
                                       focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                        </div>


                        <div>

                            <label
                                for="email"
                                class="block text-sm font-semibold
                                       text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Correo electrónico
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $usuario->email) }}"
                                required
                                maxlength="255"
                                class="w-full rounded-lg
                                       border-gray-300 dark:border-gray-700
                                       bg-gray-50 dark:bg-gray-800
                                       text-gray-900 dark:text-white
                                       focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                        </div>


                        <div>

                            <label
                                for="role"
                                class="block text-sm font-semibold
                                       text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Rol
                            </label>

                            <select
                                id="role"
                                name="role"
                                required
                                class="w-full rounded-lg
                                       border-gray-300 dark:border-gray-700
                                       bg-gray-50 dark:bg-gray-800
                                       text-gray-900 dark:text-white
                                       focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                                <option
                                    value="administrador"
                                    @selected(old('role', $usuario->role) === 'administrador')
                                >
                                    👑 Administrador
                                </option>

                                <option
                                    value="cobrador"
                                    @selected(old('role', $usuario->role) === 'cobrador')
                                >
                                    💰 Cobrador
                                </option>

                                <option
                                    value="consulta"
                                    @selected(old('role', $usuario->role) === 'consulta')
                                >
                                    👁️ Consulta
                                </option>

                            </select>

                        </div>


                        <div>

                            <label
                                for="password"
                                class="block text-sm font-semibold
                                       text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Nueva contraseña
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                minlength="8"
                                placeholder="Dejar vacío para conservarla"
                                class="w-full rounded-lg
                                       border-gray-300 dark:border-gray-700
                                       bg-gray-50 dark:bg-gray-800
                                       text-gray-900 dark:text-white
                                       placeholder-gray-500
                                       focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                        </div>


                        <div class="md:col-span-2">

                            <label
                                for="password_confirmation"
                                class="block text-sm font-semibold
                                       text-gray-700 dark:text-gray-300 mb-2"
                            >
                                Confirmar nueva contraseña
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                minlength="8"
                                placeholder="Repite la nueva contraseña"
                                class="w-full rounded-lg
                                       border-gray-300 dark:border-gray-700
                                       bg-gray-50 dark:bg-gray-800
                                       text-gray-900 dark:text-white
                                       placeholder-gray-500
                                       focus:border-indigo-500
                                       focus:ring-indigo-500"
                            >

                        </div>

                    </div>


                    <div class="pt-4
                                border-t border-gray-200 dark:border-gray-800
                                flex flex-col sm:flex-row
                                justify-end gap-3">

                        <a
                            href="{{ route('usuarios.index') }}"
                            class="inline-flex items-center justify-center
                                   px-5 py-2.5
                                   rounded-lg
                                   bg-gray-700
                                   hover:bg-gray-600
                                   text-white
                                   font-semibold
                                   transition"
                        >
                            Cancelar
                        </a>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center
                                   px-5 py-2.5
                                   rounded-lg
                                   bg-indigo-600
                                   hover:bg-indigo-700
                                   text-white
                                   font-semibold
                                   transition"
                        >
                            💾 Guardar cambios
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>