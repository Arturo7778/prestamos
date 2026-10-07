<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Mostrar lista de clientes.
     */
    public function index()
    {
        $clientes = Cliente::orderBy('nombre')->get();

        return view('clientes.index', [
            'clientes' => $clientes,
        ]);
    }

    /**
     * Mostrar formulario para crear cliente.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Guardar nuevo cliente.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'dni' => [
                'required',
                'string',
                'size:8',
                'unique:clientes,dni',
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'telefono' => [
                'nullable',
                'string',
                'max:20',
            ],

            'correo' => [
                'nullable',
                'email',
                'max:255',
                'unique:clientes,correo',
            ],

            'direccion' => [
                'nullable',
                'string',
                'max:255',
            ],

            'fecha_nacimiento' => [
                'nullable',
                'date',
            ],
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.size' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado.',

            'nombre.required' => 'El nombre es obligatorio.',

            'correo.email' => 'Ingresa un correo electrónico válido.',
            'correo.unique' => 'Este correo ya está registrado como cliente.',

            'fecha_nacimiento.date' => 'La fecha de nacimiento no es válida.',
        ]);

        Cliente::create([
            'dni' => $datos['dni'],
            'nombre' => $datos['nombre'],
            'telefono' => $datos['telefono'] ?? null,
            'correo' => $datos['correo'] ?? null,
            'direccion' => $datos['direccion'] ?? null,
            'fecha_nacimiento' => $datos['fecha_nacimiento'] ?? null,
        ]);

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente registrado correctamente.');
    }

    /**
     * Mostrar información completa del cliente.
     */
    public function show($id)
    {
        $cliente = Cliente::with([
            'prestamos.cuotas.pagos',
        ])->findOrFail($id);

        return view('clientes.show', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * Mostrar formulario para editar cliente.
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('clientes.edit', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * Actualizar cliente.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $datos = $request->validate([
            'dni' => [
                'required',
                'string',
                'size:8',
                'unique:clientes,dni,' . $cliente->id,
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'telefono' => [
                'nullable',
                'string',
                'max:20',
            ],

            'correo' => [
                'nullable',
                'email',
                'max:255',
                'unique:clientes,correo,' . $cliente->id,
            ],

            'direccion' => [
                'nullable',
                'string',
                'max:255',
            ],

            'fecha_nacimiento' => [
                'nullable',
                'date',
            ],
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.size' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado.',

            'nombre.required' => 'El nombre es obligatorio.',

            'correo.email' => 'Ingresa un correo electrónico válido.',
            'correo.unique' => 'Este correo ya está registrado como cliente.',

            'fecha_nacimiento.date' => 'La fecha de nacimiento no es válida.',
        ]);

        $cliente->update($datos);

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Eliminar cliente.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        if ($cliente->prestamos()->exists()) {
            return redirect()
                ->route('clientes.index')
                ->with(
                    'error',
                    'No puedes eliminar este cliente porque tiene préstamos registrados.'
                );
        }

        $cliente->delete();

        return redirect()
            ->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}