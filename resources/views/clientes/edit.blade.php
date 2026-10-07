<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    ✏️ Editar cliente
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Actualiza la información personal y de contacto del cliente.
                </p>

            </div>

            <a
                href="{{ route('clientes.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border
                       border-gray-300 bg-white px-4 py-2 text-sm font-semibold
                       text-gray-700 shadow-sm transition hover:bg-gray-50
                       dark:border-gray-600 dark:bg-gray-800
                       dark:text-gray-200 dark:hover:bg-gray-700"
            >
                ← Volver a clientes
            </a>

        </div>
    </x-slot>


    <div class="py-8">

        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">


            {{-- Errores de validación --}}
            @if ($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200
                            bg-red-50 p-5
                            dark:border-red-900 dark:bg-red-950/40">

                    <div class="flex items-start gap-3">

                        <div class="text-xl">
                            ⚠️
                        </div>

                        <div>

                            <h3 class="font-bold text-red-800 dark:text-red-300">
                                Hay errores en el formulario
                            </h3>

                            <ul class="mt-2 list-inside list-disc space-y-1
                                       text-sm text-red-700 dark:text-red-400">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Tarjeta principal --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200
                        bg-white shadow-xl
                        dark:border-gray-700 dark:bg-gray-900">


                {{-- Encabezado de la tarjeta --}}
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-5
                            dark:border-gray-700 dark:bg-gray-800/70">

                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center
                                    rounded-2xl bg-blue-100 text-2xl
                                    dark:bg-blue-900/40">
                            ✏️
                        </div>

                        <div>

                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Información del cliente
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Modifica los datos que deseas actualizar.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Formulario --}}
                <form
                    method="POST"
                    action="{{ route('clientes.update', $cliente) }}"
                >

                    @csrf
                    @method('PUT')


                    <div class="space-y-8 p-6 sm:p-8">


                        {{-- Información personal --}}
                        <div>

                            <div class="mb-5">

                                <h4 class="text-base font-bold text-gray-800 dark:text-white">
                                    🪪 Información personal
                                </h4>

                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Datos de identificación del cliente.
                                </p>

                            </div>


                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


                                {{-- DNI --}}
                                <div>

                                    <label
                                        for="dni"
                                        class="mb-2 block text-sm font-semibold
                                               text-gray-700 dark:text-gray-200"
                                    >
                                        DNI
                                    </label>

                                    <input
                                        id="dni"
                                        type="text"
                                        name="dni"
                                        maxlength="8"
                                        value="{{ old('dni', $cliente->dni) }}"
                                        required
                                        class="block w-full rounded-xl border-gray-300
                                               bg-white px-4 py-3 text-sm
                                               text-gray-900 shadow-sm transition
                                               focus:border-blue-500
                                               focus:ring-blue-500
                                               dark:border-gray-600 dark:bg-gray-800
                                               dark:text-white"
                                    >

                                </div>


                                {{-- Nombre --}}
                                <div>

                                    <label
                                        for="nombre"
                                        class="mb-2 block text-sm font-semibold
                                               text-gray-700 dark:text-gray-200"
                                    >
                                        Nombre completo
                                    </label>

                                    <input
                                        id="nombre"
                                        type="text"
                                        name="nombre"
                                        value="{{ old('nombre', $cliente->nombre) }}"
                                        required
                                        class="block w-full rounded-xl border-gray-300
                                               bg-white px-4 py-3 text-sm
                                               text-gray-900 shadow-sm transition
                                               focus:border-blue-500
                                               focus:ring-blue-500
                                               dark:border-gray-600 dark:bg-gray-800
                                               dark:text-white"
                                    >

                                </div>

                            </div>

                        </div>


                        {{-- Contacto --}}
                        <div class="border-t border-gray-200 pt-8
                                    dark:border-gray-700">

                            <div class="mb-5">

                                <h4 class="text-base font-bold text-gray-800 dark:text-white">
                                    📞 Información de contacto
                                </h4>

                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Información utilizada para contactar al cliente.
                                </p>

                            </div>


                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


                                {{-- Teléfono --}}
                                <div>

                                    <label
                                        for="telefono"
                                        class="mb-2 block text-sm font-semibold
                                               text-gray-700 dark:text-gray-200"
                                    >
                                        Teléfono
                                    </label>

                                    <input
                                        id="telefono"
                                        type="text"
                                        name="telefono"
                                        value="{{ old('telefono', $cliente->telefono) }}"
                                        class="block w-full rounded-xl border-gray-300
                                               bg-white px-4 py-3 text-sm
                                               text-gray-900 shadow-sm transition
                                               focus:border-blue-500
                                               focus:ring-blue-500
                                               dark:border-gray-600 dark:bg-gray-800
                                               dark:text-white"
                                    >

                                </div>


                                {{-- Correo --}}
                                <div>

                                    <label
                                        for="correo"
                                        class="mb-2 block text-sm font-semibold
                                               text-gray-700 dark:text-gray-200"
                                    >
                                        Correo electrónico
                                    </label>

                                    <input
                                        id="correo"
                                        type="email"
                                        name="correo"
                                        value="{{ old('correo', $cliente->correo) }}"
                                        class="block w-full rounded-xl border-gray-300
                                               bg-white px-4 py-3 text-sm
                                               text-gray-900 shadow-sm transition
                                               focus:border-blue-500
                                               focus:ring-blue-500
                                               dark:border-gray-600 dark:bg-gray-800
                                               dark:text-white"
                                    >

                                </div>


                                {{-- Dirección --}}
                                <div class="md:col-span-2">

                                    <label
                                        for="direccion"
                                        class="mb-2 block text-sm font-semibold
                                               text-gray-700 dark:text-gray-200"
                                    >
                                        Dirección
                                    </label>

                                    <input
                                        id="direccion"
                                        type="text"
                                        name="direccion"
                                        value="{{ old('direccion', $cliente->direccion) }}"
                                        class="block w-full rounded-xl border-gray-300
                                               bg-white px-4 py-3 text-sm
                                               text-gray-900 shadow-sm transition
                                               focus:border-blue-500
                                               focus:ring-blue-500
                                               dark:border-gray-600 dark:bg-gray-800
                                               dark:text-white"
                                    >

                                </div>

                            </div>

                        </div>


                        {{-- Información adicional --}}
                        <div class="border-t border-gray-200 pt-8
                                    dark:border-gray-700">

                            <div class="mb-5">

                                <h4 class="text-base font-bold text-gray-800 dark:text-white">
                                    🎂 Información adicional
                                </h4>

                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Información adicional del cliente.
                                </p>

                            </div>


                            <div>

                                <label
                                    for="fecha_nacimiento"
                                    class="mb-2 block text-sm font-semibold
                                           text-gray-700 dark:text-gray-200"
                                >
                                    Fecha de nacimiento
                                </label>

                                <input
                                    id="fecha_nacimiento"
                                    type="date"
                                    name="fecha_nacimiento"
                                    value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento) }}"
                                    class="block w-full rounded-xl border-gray-300
                                           bg-white px-4 py-3 text-sm text-gray-900
                                           shadow-sm transition focus:border-blue-500
                                           focus:ring-blue-500
                                           dark:border-gray-600 dark:bg-gray-800
                                           dark:text-white sm:max-w-xs"
                                >

                            </div>

                        </div>

                    </div>


                    {{-- Footer --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-gray-200
                                bg-gray-50 px-6 py-5 sm:flex-row sm:justify-end
                                dark:border-gray-700 dark:bg-gray-800/50">

                        <a
                            href="{{ route('clientes.index') }}"
                            class="inline-flex items-center justify-center rounded-xl
                                   border border-gray-300 bg-white px-5 py-3
                                   text-sm font-semibold text-gray-700 shadow-sm
                                   transition hover:bg-gray-50
                                   dark:border-gray-600 dark:bg-gray-800
                                   dark:text-gray-200 dark:hover:bg-gray-700"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   rounded-xl bg-blue-600 px-6 py-3 text-sm
                                   font-bold text-white shadow-sm transition
                                   hover:bg-blue-700 focus:outline-none
                                   focus:ring-2 focus:ring-blue-500
                                   focus:ring-offset-2"
                        >
                            💾 Guardar cambios
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>