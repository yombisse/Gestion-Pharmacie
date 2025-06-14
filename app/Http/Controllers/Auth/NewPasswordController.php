<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class NewPasswordController extends Controller
{
    public function create()
    {
        return view('auth.reset-password'); // correspond au Blade que tu as fourni
    }

    /**
     * Gère la soumission du formulaire pour réinitialiser le mot de passe.
     */
    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Recherche de l'utilisateur par email
        $user = User::where('email', $request->email)->first();

        // Mise à jour du mot de passe
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Mot de passe réinitialisé avec succès.');
    }
}
