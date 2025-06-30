@extends('layouts.admin-navbar')

@section('title', 'Tableau de bord - Personnel')

@section('content')
<main class="main-content">
    <div class="container-fluid px-2 px-md-4">
        <div class="mb-4 text-center text-lg-start">
            <h3 class="mb-2">Bienvenue, {{ Auth::user()->name }}</h3>
            <span class="badge bg-primary">{{ now()->format('l j F Y') }}</span>
        </div>

        <!-- Accès Rapide -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-lightning-charge"></i> Accès Rapide</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-sm-4 col-md-3">
                        <a href="{{ route('ventes.create') }}" class="btn btn-primary w-100 quick-btn">
                            <i class="bi bi-cart-plus"></i>
                            <span>Nouvelle Vente</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-3">
                        <a href="{{ route('produits.crud') }}" class="btn btn-success w-100 quick-btn">
                            <i class="bi bi-capsule"></i>
                            <span>Gestion Stock</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-3">
                        <a href="{{ route('clients.crud') }}" class="btn btn-info w-100 quick-btn">
                            <i class="bi bi-people"></i>
                            <span>Gestion Clients</span>
                        </a>
                    </div>
                    <div class="col-6 col-sm-4 col-md-3">
                        <a href="{{ route('produits.stocks.faibles') }}" class="btn btn-warning w-100 quick-btn">
                            <i class="bi bi-exclamation-triangle"></i>
                            <span>Stocks Faibles</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card text-white bg-success h-100">
                    <div class="card-body text-center">
                        <h5>Produits</h5>
                        <h3>{{ $stats['produits'] ?? 0 }}</h3>
                        <i class="bi bi-capsule-pill fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card text-white bg-info h-100">
                    <div class="card-body text-center">
                        <h5>Ventes</h5>
                        <h3>{{ $stats['ventes_jour'] ?? 0 }}</h3>
                        <i class="bi bi-cart-check fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body text-center">
                        <h5>Alertes</h5>
                        <h3>{{ $stats['alertes_stock'] ?? 0 }}</h3>
                        <i class="bi bi-exclamation-triangle fs-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <div class="card text-white bg-danger h-100">
                    <div class="card-body text-center">
                        <h5>Clients</h5>
                        <h3>{{ $stats['clients'] ?? 0 }}</h3>
                        <i class="bi bi-people-fill fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dernières Transactions -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5><i class="bi bi-receipt"></i> Dernières Transactions</h5>
            </div>
            <div class="card-body">
                @if(isset($dernieresVentes) && $dernieresVentes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>N°</th>
                                    <th>Client</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dernieresVentes as $vente)
                                    <tr>
                                        <td>V-{{ str_pad($vente->id, 5, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $vente->client->nom_complet ?? 'Client occasionnel' }}</td>
                                        <td>{{ number_format($vente->prix_total, 2) }} FCFA</td>
                                        <td>{{ $vente->date_vente->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('ventes.show', $vente->id) }}" class="btn btn-sm btn-outline-success">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-3">
                        <i class="bi bi-receipt-cutoff display-5"></i>
                        <p>Aucune transaction récente</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Produits en Alerte -->
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white">
                <h5><i class="bi bi-exclamation-triangle"></i> Produits en Alerte</h5>
            </div>
            <div class="card-body">
                @if(isset($alertesStock) && $alertesStock->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th>Catégorie</th>
                                    <th>Stock</th>
                                    <th>Seuil</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alertesStock as $produit)
                                    <tr class="{{ $produit->quantite == 0 ? 'table-danger' : 'table-warning' }}">
                                        <td>{{ $produit->nom }}</td>
                                        <td>{{ $produit->categorie }}</td>
                                        <td>{{ $produit->quantite }}</td>
                                        <td>{{ $produit->seuil_alerte }}</td>
                                        <td>
                                            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-arrow-up-circle"></i> Réappro
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-3">
                        <i class="bi bi-check-circle display-5"></i>
                        <p>Aucun produit en alerte</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/personnel.css') }}">
@endsection

@section('scripts')
    {{-- Si tu veux ajouter des scripts JS plus tard --}}
@endsection

@endsection
