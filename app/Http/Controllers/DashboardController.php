<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Vente;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private function checkPersonnel()
    {
        if (!Auth::check() || (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('personnel'))) {
            abort(403, 'Accès réservé aux administrateurs ou aux personnels');
        }
    }

    public function index()
    {
        $this->checkPersonnel();
        // Nombre total de produits en stock
        $totalProduits = Produit::count();

        // Nombre de ventes réalisées aujourd'hui
        $ventesAujourdhui = Vente::whereDate('date_vente', Carbon::today())->count();

        // Produits en alerte de stock : quantité <= 5
        $alertesStock = Produit::where('quantite', '<=', 5)->get();
        $nombreAlertesStock = $alertesStock->count();

        // Nombre total de clients actifs (ayant au moins une vente)
        $clientsActifs = Client::has('vente')->count();

        // Dernières ventes (ex. : les 5 plus récentes)
        $dernieresVentes = Vente::with('client')->latest()->take(5)->get();

        // Regroupement des stats
        $stats = [
            'produits' => $totalProduits,
            'ventes_jour' => $ventesAujourdhui,
            'alertes_stock' => $nombreAlertesStock,
            'clients' => $clientsActifs,
        ];

        return view('employes.dashboard', compact('stats', 'dernieresVentes', 'alertesStock'));
    }
}
