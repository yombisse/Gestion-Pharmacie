<?php

use App\Http\Controllers\RessourceHumaineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;

//page d'acceuil
Route::get('/',[ClientController::class, 'home']);
//formulaire d'inscription en get
Route::get('/register', [UserController::class,'register_form']);
//formulaire d'inscription en post
Route::post('/register/traitement', [UserController::class, 'save_form'])->name('register.traitement');
//formulaire de connection en get
Route::get('/login',[UserController::class,'login_form']);
//formulaire de connection en post
Route::post('/login/traitement', [UserController::class, 'save_login_form'])->name('login.traitement');
//formulaire de deconnection
Route::get('/logout',[ClientController::class,'logout_fonction']);
Route::post('/logout', [ClientController::class, 'logout_fonction'])->name('logout');
//tableau de board admin
Route::get('/admin',[UserController::class,'admin_board']);
//tableau de board employee
Route::get('/employee',[ClientController::class,'gestionnaire']);
//tableau de board client
Route::get('/profile_personnel',[UserController::class,'profile']);
//tableau de board admin ,gestion des roles
//Route::get('/user/create', [UserController::class, 'createAdminUser'])->name('user.create');
//Route::post('/user/store', [UserController::class, 'storeAdminUser'])->name('user.store');
//route protege pour la redirection automatique en fonction du role
/*Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin',[UserController::class,'index'])->name('auth.admin_board');
});
Route::middleware(['auth','role:employee'])->group(function(){
    Route::get('/employee',[UserController::class,'index'])->name('auth.gestionnaire_vente');
});
Route::middleware(['auth','role:client'])->group(function(){
    Route::get('/profile_personnel',[UserController::class,'index'])->name('auth.profile_personnel');
});*/
//Route pour gerer le CRUD des employes et client
Route::get('/ajouter',[RessourceHumaineController::class,'ajouter']);
Route::post('/ajouter_employe',[RessourceHumaineController::class,'client_store'])->name('ajouter_employe');
Route::get('/modifier',[RessourceHumaineController::class,'mettre_a_jour']);
Route::post('/modifier_employe',[RessourceHumaineController::class,'client_update'])->name('modifier_employe');
Route::get('supprimer',[RessourceHumaineController::class,'supprimer']);
Route::post('supprimer_etudiant',[RessourceHumaineController::class,'client_drop']);