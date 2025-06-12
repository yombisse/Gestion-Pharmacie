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
    // Méthode pour passer une commande via formulaire avec quantité
   public function create()
{
    $clients = Client::all();
    $produits = Produit::all();

    return view('commandes.ajouter_commande', compact('clients', 'produits'));
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

        $item['produit']->quantite -= $item['quantite'];
        $item['produit']->save();
    }

    // Déduire la somme du client
    /*$client->somme -= $totalCommande;
    $client->save();
 */
    return redirect()->route('commandes.index')->with('success', 'Commande ajoutée avec succès.');
}

public function index()
{
    $user = auth()->user();
    
    // Si l'utilisateur est un client
    if ($user->hasRole('client')) {
        $commandes = Commande::with(['produits'])
                      ->where('client_id', $user->id)  // Filtre par client_id
                      ->orderBy('date_commande', 'desc')
                      ->get();
    } 
    // Si c'est un admin/personnel
    else {
        $commandes = Commande::with(['client', 'produits'])
                      ->orderBy('date_commande', 'desc')
                      ->get();
    }

    return view('commandes.liste_commande', [
        'commandes' => $commandes,
        'isClient' => $user->hasRole('client')
    ]);
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
    if (!Auth::user()->hasRole('admin')) {
        abort(403);
    }
    
    $commandes = Commande::where('user_id', $userId)
                ->with(['user', 'produits'])
                ->latest()
                ->paginate(10);
    
    $client = User::findOrFail($userId);
    
    return view('admin.commandes_client', compact('commandes', 'client'));
}

}
