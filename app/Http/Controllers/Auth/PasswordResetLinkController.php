<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PasswordResetLinkController extends Controller
{
    /**
     * Affiche le formulaire d'identification de l'utilisateur pour réinitialisation.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Vérifie les infos (email, nom, prénom) et affiche le formulaire de réinitialisation si correct.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
            'firstname' => ['required', 'string'],
        ]);

        // Rechercher l'utilisateur correspondant
        $user = User::where('email', $request->email)
                    ->where('name', $request->name)
                    ->where('firstname', $request->firstname)
                    ->first();

        if ($user) {
            // Stocker l'ID temporairement en session pour le formulaire de reset
            Session::put('password_reset_user_id', $user->id);
            return redirect()->route('password.reset');
        }

        return back()->withErrors(['error' => 'Les informations fournies ne correspondent à aucun compte.']);
    }
}
