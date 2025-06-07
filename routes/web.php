<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VenteController;
use App\Models\Client;
use App\Models\Personnel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('clients.dashboard');
})->middleware(['auth', 'verified'])->name('clients.dashboard');

//admin dasboard
Route::get('/admin/dashboard', [VenteController::class,'dashboard'])->middleware(['auth', 'verified'])->name('admin.dashboard');

 /* //////////////Les routes consernant le module de gestion des employees/////////////////////////*/

//employe dasboard
Route::get('/personnel/dashboard', function () {
    return view('employes.dashboard');
})->middleware(['auth', 'verified'])->name('personnels.dashboard');


// Liste des employés
Route::get('/employes', [PersonnelController::class, 'index'])->name('personnels.crud');

Route::middleware(['auth'])->group(function () {
// Liste des clients (page principale du CRUD)
       Route::get('/employes', [PersonnelController::class, 'index'])->name('personnels.crud');

// Formulaire de création
        Route::get('/employes/create', [PersonnelController::class, 'create'])->name('personnels.create');

        // Enregistrement d'un nouvel employé
        Route::post('/employes', [PersonnelController::class, 'store'])->name('personnels.store');

        // Affichage d'un employé (optionnel selon tes vues)
        Route::get('/employes/{personnel}', [PersonnelController::class, 'show'])->name('personnels.show');

        // Formulaire d'édition
        Route::get('/employes/{personnel}/edit', [PersonnelController::class, 'edit'])->name('personnels.edit');

        // Mise à jour
        Route::put('/employes/{personnel}', [PersonnelController::class, 'update'])->name('personnels.update');

        // Suppression
        Route::delete('/employes/{personnel}', [PersonnelController::class, 'destroy'])->name('personnels.destroy');

});
/* //////////////Les routes consernant le module de gestion des produits pharmaceutiques/////////////////////////*/

 Route::middleware(['auth'])->group(function () {
        // Création
        Route::get('/produits/ajouter_produit', [ProduitController::class, 'create'])->name('produits.create');
        Route::post('/produits/ajouter_produit', [ProduitController::class, 'store'])->name('produits.store');

        // Modification
        Route::get('/produits/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
        Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');

        // Liste des produits (page principale du CRUD)
        Route::get('/produits/crud', [ProduitController::class, 'index'])->name('produits.crud');
        // Suppression
        Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');

        // Détail
        Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
        Route::get('/alertes/stocks-faibles', [ProduitController::class, 'verifierStocksFaibles'])->name('produits.stocks.faibles');

});

/* //////////////Les routes consernant le module de gestion des clients/////////////////////////*/

Route::middleware(['auth'])->group(function () {
// Liste des clients (page principale du CRUD)
        Route::get('/clients/crud', [ClientController::class, 'index'])->name('clients.crud');

        // Création
        Route::get('/clients/ajouter_client', [ClientController::class, 'create'])->name('clients.create');
        Route::post('/clients/ajouter_client', [ClientController::class, 'store'])->name('clients.store');
        // Modification
        Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
        Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
        // Suppression
        Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
        // Détail
        Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
});

/* //////////////Les routes consernant le module de gestion des ventes/////////////////////////*/

// Liste des ventes
Route::middleware(['auth'])->group(function () {
        Route::get('/ventes/crud', [VenteController::class, 'index'])->name('ventes.crud');

        // Création d'une vente
        Route::get('/ventes/ajouter_vente', [VenteController::class, 'create'])->name('ventes.create');
        Route::post('/ventes/ajouter_vente', [VenteController::class, 'store'])->name('ventes.store');

        // Modification d'une vente
        Route::get('/ventes/{id}/edit', [VenteController::class, 'edit'])->name('ventes.edit');
        Route::put('/ventes/{id}', [VenteController::class, 'update'])->name('ventes.modifier');
        Route::get('/ventes/{id}/facture/voir', [VenteController::class, 'afficherFacture'])->name('ventes.facture');

        // Suppression d'une vente
        Route::delete('/ventes/{vente}', [VenteController::class, 'destroy'])->name('ventes.destroy');

        // Détail d'une vente
        Route::get('/ventes/{vente}', [VenteController::class, 'show'])->name('ventes.show');
        });

/* //////////////Les routes consernant le module de gestion des commandes/////////////////////////*/

//commande
Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index'); // pour le redirect
Route::get('/admin/clients/{user}/commandes', [CommandeController::class, 'commandesClient'])
     ->name('admin.client.commandes');
     
Route::middleware(['auth'])->group(function () {
    Route::get('/mes-commandes', [CommandeController::class, 'mesCommandes'])
         ->name('commandes.mes_commandes');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profil/modifier', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profil/modifier', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profil/modifier/client', [ProfileController::class, 'updateClientProfile'])->name('clients.profile.update');
    
});



require __DIR__.'/auth.php';
