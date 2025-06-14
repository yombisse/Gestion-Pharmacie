<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

// Dashboards
Route::get('/dashboard', function () {
    return view('clients.dashboard');
})->middleware(['auth', 'verified'])->name('clients.dashboard');

Route::get('/admin/dashboard', [VenteController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('admin.dashboard');
Route::get('/personnel/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('personnels.dashboard');

/*Route::get('/personnel/dashboard', function () {
    return view('employes.dashboard');
})->middleware(['auth', 'verified'])->name('personnels.dashboard');
*/

/* ========== Employés ========== */
Route::middleware(['auth'])->group(function () {
    Route::get('/employes', [PersonnelController::class, 'index'])->name('personnels.crud');
    Route::get('/employes/create', [PersonnelController::class, 'create'])->name('personnels.create');
    Route::post('/employes', [PersonnelController::class, 'store'])->name('personnels.store');
    Route::get('/employes/{personnel}', [PersonnelController::class, 'show'])->name('personnels.show');
    Route::get('/employes/{personnel}/edit', [PersonnelController::class, 'edit'])->name('personnels.edit');
    Route::put('/employes/{personnel}', [PersonnelController::class, 'update'])->name('personnels.update');
    Route::delete('/employes/{personnel}', [PersonnelController::class, 'destroy'])->name('personnels.destroy');
});


/* ========== Produits ========== */
Route::middleware(['auth'])->group(function () {
    Route::get('/produits/ajouter_produit', [ProduitController::class, 'create'])->name('produits.create');
    Route::post('/produits/ajouter_produit', [ProduitController::class, 'store'])->name('produits.store');
    Route::get('/produits/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
    Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');
    Route::get('/produits/crud', [ProduitController::class, 'index'])->name('produits.crud');
    Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');
    Route::get('/produits/{produit}', [ProduitController::class, 'show'])->name('produits.show');
    Route::get('/alertes/stocks-faibles', [ProduitController::class, 'verifierStocksFaibles'])->name('produits.stocks.faibles');
});


/* ========== Clients ========== */
Route::middleware(['auth'])->group(function () {
    Route::get('/clients/crud', [ClientController::class, 'index'])->name('clients.crud');
    Route::get('/clients/ajouter_client', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients/ajouter_client', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');

   Route::get('/produits/{clientId}', [ClientController::class, 'produit_disponible'])->name('produits.disponible');

   });


/* ========== Ventes ========== */
Route::middleware(['auth'])->group(function () {
    Route::get('/ventes/crud', [VenteController::class, 'index'])->name('ventes.crud');
    Route::get('/ventes/ajouter_vente', [VenteController::class, 'create'])->name('ventes.create');
    Route::post('/ventes/ajouter_vente', [VenteController::class, 'store'])->name('ventes.store');
    Route::get('/ventes/{id}/edit', [VenteController::class, 'edit'])->name('ventes.edit');
    Route::put('/ventes/{id}', [VenteController::class, 'update'])->name('ventes.modifier');
    Route::get('/ventes/{id}/facture/voir', [VenteController::class, 'afficherFacture'])->name('ventes.facture');
    Route::delete('/ventes/{vente}', [VenteController::class, 'destroy'])->name('ventes.destroy');
    Route::get('/ventes/{vente}', [VenteController::class, 'show'])->name('ventes.show');
});


/* ========== Commandes ========== */
Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
//Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
Route::get('/admin/clients/{user}/commandes', [CommandeController::class, 'commandesClient'])->name('admin.client.commandes');

Route::middleware(['auth'])->group(function () {
    Route::get('/mes-commandes', [CommandeController::class, 'index'])->name('commandes.mes_commandes');
});


/* ========== Profils ========== */
Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profil/modifier', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profil/modifier', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profil/modifier/client', [ProfileController::class, 'updateClientProfile'])->name('clients.profile.update');
});


/* ========== Produits disponibles (filtrables) ========== */
Route::get('disponible', [ClientController::class, 'produit_disponible'])->name('produits.liste');
//Route::get('/commandes/create/{clientId}/{produitId}', [ClientController::class, 'commandes_create'])->name('commandes.create');


require __DIR__.'/auth.php';
