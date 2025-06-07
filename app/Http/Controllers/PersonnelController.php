<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            abort(403, 'Accès réservé aux administrateurs');
        }
    }

    // Affiche la liste de tous les employés
    public function index()
    {
        $this->checkAdmin();
        $personnels = Personnel::paginate(10);
        return view('employes.liste_employe', compact('personnels'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        $this->checkAdmin();
        return view('employes.ajouter_employe');
    }

    // Enregistre un nouvel employé
    public function store(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:homme,femme,personnalisee',
            'date_naissance' => 'required|date|before:today',
            'date_emploi' => 'required|date',
            'poste' => 'required|string|max:255',
            'salaire' => 'required|numeric|min:0',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'etat' => 'required|in:1,0',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'password' => 'required|min:8',
        ]);

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('uploads/images'), $photoName);
            $photoPath = 'uploads/images/' . $photoName;
        } else {
            $photoPath = null;
        }

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->nom,
            'firstname' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('personnel'); // Facultatif selon ton système de rôles

        // Création du personnel
        Personnel::create([
            'user_id' => $user->id,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'sexe' => $request->sexe,
            'date_naissance' => $request->date_naissance,
            'date_emploi' => $request->date_emploi,
            'poste' => $request->poste,
            'salaire' => $request->salaire,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'etat' => $request->etat,
            'photo' => $photoPath,
        ]);

        return redirect()->route('personnels.crud')->with('success', 'Employé ajouté avec succès.');
    }

    // Affiche le formulaire d'édition
    public function edit($id)
    {
        $this->checkAdmin();
        $personnel = Personnel::findOrFail($id);
        return view('employes.modifier_employe', compact('personnel'));
    }

    // Met à jour un employé
    public function update(Request $request, $id)
{
    $this->checkAdmin();

    $personnel = Personnel::findOrFail($id);
    $user = $personnel->user;

    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'sexe' => 'required|in:homme,femme,personnalisee',
        'date_naissance' => 'required|date|before:today',
        'date_emploi' => 'required|date',
        'poste' => 'required|string|max:255',
        'salaire' => 'required|numeric|min:0',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'telephone' => 'required|string|max:20',
        'adresse' => 'required|string|max:255',
        'etat' => 'required|in:1,0',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        'password' => 'nullable|min:8',
    ]);

    // Traitement de la photo
    if ($request->hasFile('photo')) {
        // Supprime l'ancienne photo si elle existe
        if ($personnel->photo && file_exists(public_path($personnel->photo))) {
            unlink(public_path($personnel->photo));
        }

        $photo = $request->file('photo');
        $photoName = time() . '_' . $photo->getClientOriginalName();
        $photo->move(public_path('uploads/images'), $photoName);
        $photoPath = 'uploads/images/' . $photoName;
    } else {
        $photoPath = $personnel->photo;
    }

    // Mise à jour de l'utilisateur
    $user->update([
        'name' => $request->nom,
        'firstname' => $request->prenom,
        'email' => $request->email,
        'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
    ]);

    // Mise à jour du personnel
    $personnel->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'sexe' => $request->sexe,
        'date_naissance' => $request->date_naissance,
        'date_emploi' => $request->date_emploi,
        'poste' => $request->poste,
        'salaire' => $request->salaire,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
        'etat' => $request->etat,
        'photo' => $photoPath,
        'email' => $request->email,
    ]);


    return redirect()->route('personnels.crud')->with('success', 'Employé mis à jour avec succès.');
}




    // Supprime un employé
   public function destroy(Personnel $personnel)
{
    $this->checkAdmin();

    // Supprime la photo si elle existe (dans public/uploads/images)
    if ($personnel->photo) {
        $photoPath = public_path($personnel->photo);
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
    }

    // Supprime l'utilisateur associé
    if ($personnel->user) {
        $personnel->user->delete();
    }

    // Supprime le personnel
    $personnel->delete();

    return redirect()->route('personnels.crud')->with('success', 'Employé supprimé.');
}

  public function show(Personnel $personnel)

    {
        $this->checkAdmin();
        return view('employes.show', compact('personnel'));
    }
    // Recherche par email
    public function searchByEmail(Request $request)
    {
        $this->checkAdmin();
        $request->validate(['email' => 'required|email']);
        
        $personnel = Personnel::where('email', $request->email)->first();

        if (!$personnel) {
            return redirect()->back()->with('error', 'Aucun employé trouvé.');
        }

        return redirect()->route('personnels.edit', $personnel);
    }
    
}