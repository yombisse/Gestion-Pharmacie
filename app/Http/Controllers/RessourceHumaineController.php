<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class RessourceHumaineController extends Controller
{
    /**
     * Affiche le formulaire d'ajout d'employé
     */
    public function ajouter()
    {
        return view('clients.create');
    }

    /**
     * Enregistre un nouvel employé dans la base de données
     */
    public function client_store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'poste' => 'required|string|max:255',
            'salaire' => 'required|numeric|min:0',
            'email' => 'required|string|email|unique:users,email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'password' => 'required|string|min:8',
        ]);

        // Enregistrement dans la table users
        $user = new User();
        $user->name = $request->nom;
        $user->firstname = $request->prenom;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Enregistrement dans la table employees
        $employe = new Employee();
        $employe->user_id = $user->id;
        $employe->telephone = $request->telephone;
        $employe->adresse = $request->adresse;
        $employe->poste = $request->poste;
        $employe->salaire = $request->salaire;

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $chemin = $request->file('photo')->store('photos', 'public');
            $employe->photo = $chemin;
    } else {
        // Debug pour voir ce qu'on a dans photo
            Log::warning('Aucun fichier photo reçu ou fichier invalide');
            Log::warning($request->file('photo'));
    }

        $employe->date_emploi = now();
        $employe->save();
        return redirect()->back()->with('status', "L'employé a été ajouté avec succès.");

    }

    /**
     * Formulaire de modification d'un employé
     */
    public function mettre_a_jour()
    {
        return view('clients.edit');
    }

    /**
     * Affiche la liste des employés pour suppression
     */
    public function supprimer()
    {
        return view('client.index');
    }
}
