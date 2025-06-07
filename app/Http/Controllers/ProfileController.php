<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Personnel;
use App\Models\Client;
use Illuminate\Support\Str;

class ProfileController extends Controller
{


        public function showProfile()
        {
            $user = Auth::user();

            if ($user->hasRole('personnel')) {
                $personnel = Personnel::where('user_id', $user->id)->firstOrFail();
                return view('employes.show_profile', compact('personnel'));
            }

            if ($user->hasRole('client')) {
                $client = Client::where('user_id', $user->id)->firstOrFail();
                return view('clients.show_profile', compact('client'));
            }

            abort(403, 'Accès non autorisé.');
        }


        public function editProfile()
    {
            $user = Auth::user();

            if ($user->hasRole('personnel')) {
                $personnel = Personnel::where('user_id', $user->id)->firstOrFail();
                return view('employes.profile', compact('personnel'));
            }

            if ($user->hasRole('client')) {
               // Dans le contrôleur
                $client =Client::where('user_id', $user->id)->firstOrFail();
                return view('clients.profile', compact('client'));
            }

            abort(403, 'Accès non autorisé.');
    }



    public function updateProfile(Request $request)
        {
            $user = Auth::user();
            $personnel = Personnel::where('user_id', $user->id)->firstOrFail();

            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'sexe' => 'required|in:homme,femme,personnalisee',
                'date_naissance' => 'required|date|before:today',
                'telephone' => 'required|string|max:20',
                'adresse' => 'required|string|max:255',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
                'password' => 'nullable|min:8',
            ]);

            // Gestion de la photo
            if ($request->hasFile('photo')) {
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

            if ($request->filled('password')) {
                 if (!Hash::check($request->current_password, auth()->user()->password)) {
                    return back()->with('error', 'L\'ancien mot de passe est incorrect');
        }
        
        $request->validate([
            'password' => 'required|confirmed|min:8',
            'current_password' => 'required',
        ]);
        
        // Mettre à jour le mot de passe
        auth()->user()->update(['password' => Hash::make($request->password)]);
}

            // Mise à jour de l'utilisateur
            $user->update([
                'name' => $request->nom,
                'firstname' => $request->prenom,
                'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            ]);

            // Mise à jour des infos du personnel
            $personnel->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'sexe' => $request->sexe,
                'date_naissance' => $request->date_naissance,
                'telephone' => $request->telephone,
                'adresse' => $request->adresse,
                'photo' => $photoPath,
            ]);

            return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
        }

  public function updateClientProfile(Request $request)
{
    $user = auth()->user();
    $client = $user->client;

    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'nullable|string|max:20',
        'adresse' => 'nullable|string|max:255',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'current_password' => 'nullable|required_with:password|string',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Vérification du mot de passe actuel si nouveau mot de passe fourni
    if ($request->filled('password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'L\'ancien mot de passe est incorrect.');
        }
        $user->password = Hash::make($request->password);
    }

    // Mise à jour de l'avatar si une nouvelle image est chargée
    if ($request->hasFile('photo')) {
        // Supprimer l'ancienne photo si elle existe
        if ($user->avatar && file_exists(public_path($user->avatar))) {
            unlink(public_path($user->avatar));
        }

        $photo = $request->file('photo');
        $photoName = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
        $photoPath = 'uploads/images/' . $photoName;
        $photo->move(public_path('uploads/images'), $photoName);

        $user->avatar = $photoPath;
    }

    // Suppression de la photo si demandé
    if ($request->has('remove_photo')) {
        if ($user->avatar && file_exists(public_path($user->avatar))) {
            unlink(public_path($user->avatar));
        }
        $user->avatar = null;
    }

    $user->save();

    $client->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
    ]);

    return redirect()->route('profile.show')->with('success', 'Profil mis à jour avec succès.');
}


}


