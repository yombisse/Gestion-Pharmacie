<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Affiche le formulaire d'inscription.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Traite la demande d'inscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'sexe' => ['required', 'in:homme,femme,personnalisee'],
            'telephone' => ['required', 'string', 'max:20', 'unique:clients,telephone'],
            'adresse' => ['required', 'string', 'max:255'],
        ]);

        // Création du User
        $user = User::create([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Création du Client lié
        $client = Client::create([
            'user_id' => $user->id,
            'nom' => $request->name,
            'prenom' => $request->firstname,
            'sexe' => $request->sexe,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
        ]);

        // Vérifie si le client a bien été créé
        if (!$client) {
            return back()->withErrors(['error' => 'Erreur lors de la création du profil client.']);
        }

        // Événement Laravel
        event(new Registered($user));

        // Connexion automatique de l'utilisateur
        Auth::login($user);
        $user->load('client');

        // Attribution du rôle client
        $user->assignRole('client');


        // Redirection vers le tableau de bord client
        return redirect()->route('clients.dashboard');
    }
}
