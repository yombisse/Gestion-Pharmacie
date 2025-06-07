<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Produit;
use App\Models\Client;
use App\Models\Commande;
use App\Models\User;

class VenteController extends Controller
{
     private function checkPersonnel()
    {
        if (!Auth::check() || !Auth::user()->hasRole('admin')) {
            if(!Auth::check() || !Auth::user()->hasRole('personnel')){

            
            abort(403, 'Accès réservé aux administrateurs ou aux personnels');
        }
    }
    }
      public function create()
{
    $this->checkPersonnel();
    $produits = Produit::where('quantite', '>', 0)->get(); // seulement les produits en stock
    $clients = Client::all();
    return view('ventes.ajouter_vente',compact('produits','clients'));
}

public function index()
{
    $this->checkPersonnel();
    // On récupère les ventes avec les infos du produit (relation)
    $ventes = Vente::with('produit')->latest()->paginate(10); // pagination 10 par page

    return view('ventes.liste_vente', compact('ventes'));
}
public function store(Request $request)
{
    $this->checkPersonnel();
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'produit_id' => 'required|exists:produits,id',
        'quantite_vente' => 'required|integer|min:1',
        'date_vente' => 'required|date',
    ]);

    $produit = Produit::findOrFail($request->produit_id);

    if ($produit->quantite < $request->quantite_vente) {
        return back()->withErrors(['quantite_vente' => 'Stock insuffisant pour ce produit.'])->withInput();
    }

    $client = Client::findOrFail($request->client_id);

    $prix_total = $request->quantite_vente * $produit->prix;

    Vente::create([
        'produit_id' => $produit->id,
        'client_id' => $client->id,
        'client_nom' => $client->nom,
        'quantite_vente' => $request->quantite_vente,
        'prix_total' => $prix_total,
        'date_vente' => $request->date_vente,
    ]);

    // Mettre à jour le stock
    $produit->quantite -= $request->quantite_vente;
    $produit->save();

    return redirect()->route('ventes.crud')->with('success', 'Vente enregistrée avec succès.');
}



public function show(Vente $vente)

{
    $this->checkPersonnel();
    // Charge les relations si besoin
    $vente->load('produit', 'client');

    return view('ventes.show', compact('vente'));
}

    public function Dashboard()
    {
        // Récupération des données de base
        $counts = [
            'productCount' => Produit::count(),
            'orderCount' => Commande::count(),
            'clientCount' => Client::count(),
            'userCount' => User::count(),
        ];

        // Données pour le graphique des ventes mensuelles
        $monthlySalesData = Vente::getMonthlySales();
        
        $months = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];
        
        $salesLabels = [];
        $salesValues = [];
        
        foreach ($months as $key => $month) {
            $salesLabels[] = $month;
            $salesValues[] = $monthlySalesData[$key] ?? 0;
        }

        // Données pour le top des produits
        $topProducts = Produit::getTopSellingProducts(5);
        
        return view('admin.dashboard', array_merge($counts, [
            'salesLabels' => $salesLabels,
            'salesValues' => $salesValues,
            'topProducts' => $topProducts,
            'topProductsLabels' => $topProducts->pluck('nom'),
            'topProductsData' => $topProducts->pluck('ventes_count')
        ]));
    }
    public function edit($id)
{
    $vente = Vente::findOrFail($id);
    $produits = Produit::all(); // Pour permettre de choisir un autre produit si besoin
    return view('ventes.modifier_vente', compact('vente', 'produits'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'produit_id' => 'required|exists:produits,id',
        'quantite_vente' => 'required|numeric|min:1',
        'client_nom' => 'required|string|max:255',
        'date_vente' => 'required|date',
    ]);

    $vente = Vente::findOrFail($id);
    $produit = Produit::findOrFail($request->produit_id);

    $vente->produit_id = $produit->id;
    $vente->quantite_vente = $request->quantite_vente;
    $vente->prix_total = $produit->prix * $request->quantite_vente;
    $vente->client_nom = $request->client_nom;
    $vente->date_vente = $request->date_vente;
    $vente->save();

    return redirect()->route('ventes.crud')->with('success', 'Vente mise à jour avec succès.');
}
public function afficherFacture($id)
{
    $vente = Vente::with('produit')->findOrFail($id);
    return view('ventes.facture', compact('vente'));
}

}