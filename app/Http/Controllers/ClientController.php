<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class ClientController extends Controller
{
    private function checkPersonnel()
        {
            if (!Auth::check() || !Auth::user()->hasRole('admin')) {
                if(!Auth::check() || !Auth::user()->hasRole('personnel')){

                
                abort(403, 'Accès réservé aux administrateurs ou aux personnels');
            }
        }
        }


    public function index()
    {
        $this->checkPersonnel();
        $clients = Client::when(request('search'), function($query) {
            $query->where('nom', 'like', '%'.request('search').'%')
                  ->orWhere('prenom', 'like', '%'.request('search').'%')
                  ->orWhere('telephone', 'like', '%'.request('search').'%');
        })->orderBy('nom')->paginate(10);

        return view('clients.liste_client', compact('clients'));
    }

    public function create()
    {
        return view('clients.ajouter_client');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'sexe' => 'required|in:homme,femme,personnalisee',
            'telephone' => 'required|string|max:20|unique:clients',
            'adresse' => 'required|string|max:255',
        ]);

        // Création du User
        $user = User::create([
            'name' => $validated['nom'],
            'firstname' => $validated['prenom'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Création du Client lié
        Client::create([
            'user_id' => $user->id,
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'sexe' => $validated['sexe'],
            'telephone' => $validated['telephone'],
            'adresse' => $validated['adresse'],
        ]);
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move(public_path('uploads/images'), $filename);

            // Enregistre juste le nom ou chemin relatif dans la base (ex: 'uploads/images/nomfichier.jpg')
            $user->avatar = 'uploads/images/' . $filename;
            $user->save();
        // Attribution du rôle client si tu utilises Spatie
        $user->assignRole('client');

        return redirect()->route('clients.crud')->with('success', 'Client ajouté avec succès');
        }
    }



    public function show(Client $client)
    
    {
        $this->checkPersonnel();
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        $this->checkPersonnel();
        return view('clients.modifier_client', compact('client'));
    }

   public function update(Request $request, Client $client)
{
    $this->checkPersonnel();

    // Validation
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . ($client->user->id ?? 'NULL'),
        'sexe' => 'required|in:homme,femme,personnalisee',
        'telephone' => 'required|string|max:20|unique:clients,telephone,' . $client->id,
        'adresse' => 'required|string|max:255',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'password' => 'nullable|string|min:6|confirmed', // confirmé avec password_confirmation
    ]);

    // Mise à jour du client
    $client->update([
        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'sexe' => $validated['sexe'],
        'telephone' => $validated['telephone'],
        'adresse' => $validated['adresse'],
    ]);

    // Mise à jour du user lié (si relation présente)
    if ($client->user) {
        $user = $client->user;
        $user->name = $validated['nom'];
        $user->firstname = $validated['prenom'];
        $user->email = $validated['email'];

        // Mise à jour du mot de passe uniquement si rempli
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        // Gestion avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move(public_path('uploads/images'), $filename);

            $user->avatar = 'uploads/images/' . $filename;
        }

        $user->save();
    }

    return redirect()->route('clients.crud')->with('success', 'Client et utilisateur mis à jour avec succès.');
}



    public function destroy(Client $client)
    {
        $this->checkPersonnel();
        $client->delete();
        return redirect()->route('clients.crud')->with('success', 'Client supprimé avec succès');
    }
}

