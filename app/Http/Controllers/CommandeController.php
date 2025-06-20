<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
class CommandeController extends Controller
{
    private function checkPersonnel()
    {
        if (!Auth::check() || (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('personnel'))) {
            abort(403, 'Accès réservé aux administrateurs ou aux personnels');
        }
    }

    // Méthode pour passer une commande via formulaire avec quantité
   public function create()
{
    $produits = Produit::all();
    $user =Auth::user();
    $client = $user->client; // Essaye de récupérer le client lié

    return view('commandes.ajouter_commande', compact('produits'));
}


public function store(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'date_commande' => 'required|date',
        'produits.*.id' => 'required|exists:produits,id',
        'produits.*.quantite' => 'required|integer|min:1',
    ]);

    $client = Client::findOrFail($request->client_id);
    $totalCommande = 0;
    $produitsCommandes = [];

    // Vérification du stock et calcul du total
    foreach ($request->produits as $produitData) {
        $produit = Produit::findOrFail($produitData['id']);
        $quantiteDemandee = $produitData['quantite'];

        if ($quantiteDemandee > $produit->quantite) {
            return back()->withErrors(["Le produit {$produit->nom} n'a pas assez de stock."])->withInput();
        }

        $totalCommande += $quantiteDemandee * $produit->prix;
        $produitsCommandes[] = [
            'produit' => $produit,
            'quantite' => $quantiteDemandee,
            'prix_unitaire' => $produit->prix,
        ];
    }

   
    // Créer la commande
    $commande = Commande::create([
        'client_id' => $client->id,
        'date_commande' => now(),
        'statut' => 'en_attente',
        'total_prix_commande' => $totalCommande,
    ]);
        $sous_total = $quantiteDemandee * $produit->prix;
    // Attacher les produits et mettre à jour le stock
    foreach ($produitsCommandes as $item) {
        $commande->produits()->attach($item['produit']->id, [
            'quantite' => $item['quantite'],
            'prix_unitaire' => $item['prix_unitaire'],
            'sous_total' => $sous_total, 
        ]);

        //$item['produit']->quantite -= $item['quantite'];
        $item['produit']->save();
    }

    // Déduire la somme du client
    /*$client->somme -= $totalCommande;
    $client->save();
 */
    return redirect()->route('commandes.mes_commandes')->with('success', 'Commande ajoutée avec succès.');
}

public function index()
{
    $user = Auth::user();

    // Vérifie que l'utilisateur est bien un client avec une relation Client définie
    if (!$user->client) {
        abort(403, 'Aucun client associé à cet utilisateur.');
    }

    // Récupère les commandes du client connecté
    $commandes = Commande::with('produits')
                  ->where('client_id', $user->client->id)
                  ->orderBy('date_commande', 'desc')
                  ->get();

    return view('clients.commandes.index', compact('commandes'));
}
/*public function mesCommandes()
    {
        // Récupère l'utilisateur connecté avec ses commandes
        $user = Auth::user();
        $commandes = $user->commandes()->with('produits')->latest()->paginate(10);
        
        return view('commandes.mes_commandes', compact('commandes'));
    }*/
    public function commandesClient($userId)
{
    // Vérifier si l'utilisateur est admin
    $this->checkPersonnel();
    $commandes = Commande::where('user_id', $userId)
                ->with(['user', 'produits'])
                ->latest()
                ->paginate(10);
    
    $client = User::findOrFail($userId);
    
    return view('admin.commandes_client', compact('commandes', 'client'));
}

}
