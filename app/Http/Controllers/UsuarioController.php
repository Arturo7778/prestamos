<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Mostrar todos los usuarios.
     */
    public function index()
    {
        $usuarios = User::orderBy('name')->get();

        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar formulario para crear usuario.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Guardar nuevo usuario.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'role' => [
                'required',
                Rule::in($this->rolesDisponibles()),
            ],
        ], [
            'name.required' => 'El nombre es obligatorio.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'email.unique' => 'Ese correo ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',

            'role.required' => 'Debes seleccionar un rol.',
            'role.in' => 'El rol seleccionado no es válido.',
        ]);

        DB::transaction(function () use ($datos) {
            User::create([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'password' => Hash::make($datos['password']),
                'role' => $datos['role'],
            ]);
        });

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Mostrar información del usuario.
     */
    public function show(User $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Actualizar usuario.
     */
    public function update(Request $request, User $usuario)
    {
        $datos = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($usuario->id),
            ],

            'role' => [
                'required',
                Rule::in($this->rolesDisponibles()),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'name.required' => 'El nombre es obligatorio.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'email.unique' => 'Ese correo ya está registrado.',

            'role.required' => 'Debes seleccionar un rol.',
            'role.in' => 'El rol seleccionado no es válido.',

            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        if (
            $usuario->id === auth()->id() &&
            $datos['role'] !== 'administrador'
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'No puedes quitarte el rol de administrador a ti mismo.'
                );
        }

        DB::transaction(function () use ($usuario, $datos) {
            $usuario->name = $datos['name'];
            $usuario->email = $datos['email'];
            $usuario->role = $datos['role'];

            if (!empty($datos['password'])) {
                $usuario->password = Hash::make(
                    $datos['password']
                );
            }

            $usuario->save();
        });

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar usuario.
     */
    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return redirect()
                ->route('usuarios.index')
                ->with(
                    'error',
                    'No puedes eliminar tu propio usuario.'
                );
        }

        if ($usuario->esAdministrador()) {
            $cantidadAdministradores = User::where(
                'role',
                'administrador'
            )->count();

            if ($cantidadAdministradores <= 1) {
                return redirect()
                    ->route('usuarios.index')
                    ->with(
                        'error',
                        'No puedes eliminar al único administrador del sistema.'
                    );
            }
        }

        DB::transaction(function () use ($usuario) {
            $usuario->delete();
        });

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Roles permitidos por el sistema.
     */
    private function rolesDisponibles(): array
    {
        return [
            'administrador',
            'cobrador',
            'consulta',
        ];
    }
}