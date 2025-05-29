<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login_form(Request $request) {
        if ($request->session()->get('user')) {
            return redirect("/profile_personnel")->with("status", "Vous êtes déjà connecté(e).");
        }
        return view("auth.login");
    }

    public function register_form(Request $request) {
        if ($request->session()->get('user')) {
            return redirect("/profile_personnel")->with("status", "Vous êtes déjà connecté(e).");
        }
        return view("auth.register");
    }

    public function admin_board() {
        return view("auth.admin_board");
    }

    public function profile() {
        return view("auth.profile_personnel");
    }

    public function gestionnaire() {
        return view("auth.gestionnaire_vente");
    }

    public function save_form(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'firstname'=>'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // hachage du mot de passe
        $user->save();

        $user->assignRole('client'); // Assigne le rôle via Spatie

        return redirect('/login')->with('status', 'Inscription faite avec succès.');
    }

    public function save_login_form(Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    $user = User::where('email', $request->input('email'))->first();

    if ($user && Hash::check($request->input('password'), $user->password)) {
        Auth::login($user); // Connexion via Auth

        // Redirection selon le rôle
        if ($user->hasRole('admin')) {
            return redirect('/admin');
        } elseif ($user->hasRole('employee')) {
            return redirect('/employee');
        } elseif ($user->hasRole('client')) {
            return redirect('/profile_personnel');
        } else {
            Auth::logout();
            return redirect('/login')->withErrors("Aucun rôle défini pour cet utilisateur.");
        }
    } else {
        return back()->with('status', 'Identifiants incorrects.');
    }
}


    public function createAdminUser() {
        return view('auth.create');
    }

    public function storeAdminUser(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole($request->role); // Attribution du rôle

        return redirect()->back()->with('status', 'Utilisateur créé avec succès');
    }

    /*public function index(Request $request) {
        $user = Auth::user(); // Utilise le système de session d'Auth Laravel

        if (!$user) {
            return redirect('/login')->withErrors("Vous n'êtes pas connecté.");
        }

        if ($user->hasRole('admin')) {
            return view('auth.admin_board');
        } elseif ($user->hasRole('employee')) {
            return view('auth.gestionnaire_vente');
        } elseif ($user->hasRole('client')) {
            return view('auth.profile_personnel');
        } else {
            Auth::logout();
            return redirect('/login')->withErrors("Aucun rôle défini pour cet utilisateur.");
        }
    } */
}
