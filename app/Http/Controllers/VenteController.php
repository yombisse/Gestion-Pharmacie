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
        if (!Auth::check() || (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('personnel'))) {
            abort(403, 'Accès réservé aux administrateurs ou au personnel');
        }
    }

    public function create()
    {
        $this->checkPersonnel();

        $produits = Produit::where('quantite', '>', 0)->get();
        $clients = Client::all();
        $commandes = Commande::whereDoesntHave('vente')->with('client')->get(); // on récupère aussi les clients liés à chaque commande

        return view('ventes.ajouter_vente', compact('produits', 'clients', 'commandes'));
    }

    public function store(Request $request)
    {
        $this->checkPersonnel();

        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'produit_id' => 'required|exists:produits,id',
            'quantite_vente' => 'required|integer|min:1',
            'date_vente' => 'required|date',
            'commande_id' => 'required|exists:commandes,id',
        ]);

        $produit = Produit::findOrFail($request->produit_id);
        if ($produit->quantite < $request->quantite_vente) {
            return back()->withErrors(['quantite_vente' => 'Stock insuffisant pour ce produit.'])->withInput();
        }

        $client = Client::findOrFail($request->client_id);
        $commande = Commande::findOrFail($request->commande_id);
        $prix_total = $request->quantite_vente * $produit->prix;

        // Création de la vente
        $vente = Vente::create([
            'produit_id' => $produit->id,
            'client_id' => $client->id,
            'client_nom' => $client->nom,
            'quantite_vente' => $request->quantite_vente,
            'prix_total' => $prix_total,
            'date_vente' => $request->date_vente,
            'commande_id' => $commande->id,
        ]);

        // Mise à jour du stock
        $produit->decrement('quantite', $request->quantite_vente);

        // Mise à jour du statut de la commande
        $commande->statut = 'Validée';
        $commande->save();

        return redirect()->route('ventes.crud')->with('success', 'Vente enregistrée et commande validée.');
    }

    public function index()
    {
        $this->checkPersonnel();

        $ventes = Vente::with('produit', 'commande')->latest()->paginate(10);
        return view('ventes.liste_vente', compact('ventes'));
    }

    public function show(Vente $vente)
    {
        $this->checkPersonnel();
        $vente->load('produit', 'client', 'commande');
        return view('ventes.show', compact('vente'));
    }

    public function edit($id)
    {
        $this->checkPersonnel();
        $vente = Vente::findOrFail($id);
        $produits = Produit::all();
        return view('ventes.modifier_vente', compact('vente', 'produits'));
    }

    public function update(Request $request, $id)
    {
        $this->checkPersonnel();

        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite_vente' => 'required|integer|min:1',
            'client_nom' => 'required|string|max:255',
            'date_vente' => 'required|date',
        ]);

        $vente = Vente::findOrFail($id);
        $produit = Produit::findOrFail($request->produit_id);

        $vente->update([
            'produit_id' => $produit->id,
            'quantite_vente' => $request->quantite_vente,
            'prix_total' => $produit->prix * $request->quantite_vente,
            'client_nom' => $request->client_nom,
            'date_vente' => $request->date_vente,
        ]);

        return redirect()->route('ventes.crud')->with('success', 'Vente mise à jour avec succès.');
    }

    public function afficherFacture($id)
    {
        $vente = Vente::with('produit', 'client', 'commande')->findOrFail($id);
        $user = Auth::user();

        if ($user->hasRole('admin') || $user->hasRole('personnel')) {
            return view('ventes.facture', compact('vente'));
        }

        if ($user->hasRole('client')) {
            if ($vente->client->user_id !== $user->id) {
                abort(403, 'Accès refusé : cette facture ne vous appartient pas.');
            }
            return view('ventes.facture', compact('vente'));
        }

        abort(403, 'Accès refusé.');
    }

    public function Dashboard()
    {
        $this->checkPersonnel();

        $counts = [
            'productCount' => Produit::count(),
            'orderCount' => Commande::count(),
            'clientCount' => Client::count(),
            'userCount' => User::count(),
        ];

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

        $topProducts = Produit::getTopSellingProducts(5);

        return view('admin.dashboard', array_merge($counts, [
            'salesLabels' => $salesLabels,
            'salesValues' => $salesValues,
            'topProducts' => $topProducts,
            'topProductsLabels' => $topProducts->pluck('nom'),
            'topProductsData' => $topProducts->pluck('ventes_count')
        ]));
    }
}
