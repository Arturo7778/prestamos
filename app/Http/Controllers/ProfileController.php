<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Mostrar formulario de perfil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Actualizar información del perfil.
     */
    public function update(
        ProfileUpdateRequest $request
    ): RedirectResponse {
        $usuario = $request->user();

        $usuario->fill(
            $request->validated()
        );

        if ($usuario->isDirty('email')) {
            $usuario->email_verified_at = null;
        }

        $usuario->save();

        return Redirect::route('profile.edit')
            ->with(
                'status',
                'profile-updated'
            );
    }

    /**
     * Eliminar la cuenta del usuario.
     */
    public function destroy(
        Request $request
    ): RedirectResponse {
        $request->validateWithBag(
            'userDeletion',
            [
                'password' => [
                    'required',
                    'current_password',
                ],
            ]
        );

        $usuario = $request->user();

        Auth::logout();

        $usuario->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}