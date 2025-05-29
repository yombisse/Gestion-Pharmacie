<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function home() {
        return view("auth.home");
    }

    public function login_form(Request $request) {
        if($request->session()->get('user')){
            return redirect("/profile_personnel")->with("status","Vous etes deja connecté(e).");
        }
        return view("auth.login");
    }

    public function register_form(Request $request) {
        return view("auth.register");
        if($request->session()->get('user')){
            return redirect("/profile_personnel")->with("status","Vous etes deja connecté(e).");
        }
    }
    public function admin_board() {
        return view("auth.admin_board");
    }
    public function gestionnaire() {
        return view("auth.gestionnaire_vente");
    }
    public function logout_fonction(Request $request) {
       $request->session()->forget('user');
       return redirect("/login")->with("status","Vous venez de vous deconnecter.");
    }

    /*public function save_form(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|min:8',
        

        ]);
        $client = new Client();
        $client->nom = $request->name;
        $client->prenom = $request->firstname;
        $client->email = $request->email;
        $client->mot_de_passe = bcrypt($request->password); // hachage du mot de passe
        $client->save();
        $client->assignRole('client');
        

        return redirect('/register')->with('status','Inscription fait avec succes.');

    }
     // Assure-toi d’avoir bien importé cette ligne

    public function save_login_form(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);

            $client = Client::where('email', $request->input('email'))->first();

            if ($client) {
                // Vérifie le mot de passe stocké dans 'mot_de_passe' et pas 'password'
                if (Hash::check($request->input('password'), $client->mot_de_passe)) {

                    $request->session()->put('client', $client);
                    return redirect("/profile_personnel"); // Rediriger vers le profil si login réussi
                } else {
                    return back()->with('status', 'Mot de passe incorrect.');
                }
            } else {
                return back()->with('status', 'Aucun compte utilisateur trouvé avec cet email.');
            }
}*/

/*    public function profile(){
        return view("auth.profile_personnel");
    }*/
}
