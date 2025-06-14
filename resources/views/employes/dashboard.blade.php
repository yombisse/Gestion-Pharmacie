@extends('layouts.app')

@section('title', 'Tableau de bord - Personnel')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .admin-container {
        display: flex;
        flex: 1;
        margin-top: 56px; /* hauteur navbar */
    }
    /* Sidebar */
    .sidebar {
        width: 15%;
        background-color: #343a40;
        color: white;
        position: fixed;
        top: 56px;
        bottom: 0;
        left: 0;
        overflow-y: auto;
        transition: margin-left 0.3s ease;
    }
    .sidebar-content {
        padding: 20px;
    }
    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 8px 0;
        text-decoration:none;
    }
    .sidebar a.active,
    .sidebar a:hover {
        background-color: #495057;
    }
    /* Contenu principal */
    .main-content {
        flex: 1;
        margin-left: 250px;
        padding: 20px;
        min-height: calc(100vh - 56px);
        transition: margin-left 0.3s ease;
    }
    /* Dropdown menu dark style */
    .dropdown-menu-dark {
        background-color: #343a40;
        border-color: #495057;
    }
    .dropdown-menu-dark .dropdown-item {
        color: rgba(255,255,255,.75);
    }
    .dropdown-menu-dark .dropdown-item:hover {
        background-color: #495057;
        color: #fff;
    }

    /* Responsive sidebar */
    @media (max-width: 992px) {
        .sidebar {
            margin-left: -250px;
            position: fixed;
          
        }
        .sidebar.active {
            margin-left: 0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.3);
        }
        .main-content {
            margin-left: 0;
        }
    }

    /* Bouton toggle sidebar */
    .sidebar-toggle-btn {
        position: fixed;
        top: 70px;
        left: 10px;
        z-index: 1100;
        border: none;
        background-color: #343a40;
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        display: none;
    }
    @media (max-width: 992px) {
        .sidebar-toggle-btn {
            display: block;
        }
    }
    
    /* Nouveaux styles pour la section accès rapide */
    .quick-access-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .quick-access-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    }
    .quick-access-icon {
        font-size: 1.75rem;
        margin-bottom: 10px;
    }
    .quick-access-btn {
        border-radius: 8px;
        padding: 12px;
        font-weight: 500;
    }
</style>

<div class="admin-container">
    <!-- Sidebar (inchangée) -->
    <nav class="sidebar p-3 text-white">
        <h4 class="text-center mb-3"><i class="bi bi-shield-lock"></i>Personnel</h4>
        <div class="text-center mb-3">
            @if(Auth::user()->avatar && file_exists(public_path(Auth::user()->avatar)))
             <img src="{{ asset(Auth::user()->avatar) }}" class="rounded-circle" width="60" height="60" alt="Avatar">
        @else
             <img src="{{ asset('uploads/images/avatar.jpg') }}" class="rounded-circle" width="60" height="60" alt="Avatar par défaut">
        @endif

            <h5 class="mt-2">{{ Auth::user()->firstname }} {{ Auth::user()->name }}</h5>
            @if(Auth::user()->personnel)
                <span class="badge bg-success">{{ Auth::user()->personnel->poste }}</span>
            @endif
        </div>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link text-white active">
                    <i class="bi bi-speedometer2 me-2"></i> Tableau de bord
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownProduits" data-bs-toggle="dropdown">
                    <i class="bi bi-capsule me-2"></i> Gestion Stock
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownProduits">
                    <li><a class="dropdown-item" href="{{ route('produits.crud') }}"><i class="bi bi-plus-circle me-2"></i> Gérer</a></li>
                    <li><a class="dropdown-item" href="{{ route('produits.crud') }}"><i class="bi bi-box-seam me-2"></i> Stock disponible</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownClients" data-bs-toggle="dropdown">
                    <i class="bi bi-people me-2"></i> Clients
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownClients">
                    <li><a class="dropdown-item" href="{{ route('clients.crud') }}"><i class="bi bi-pencil-square me-2"></i> Gérer les clients</a></li>
                    <li><a class="dropdown-item" href="{{ route('clients.crud') }}"><i class="bi bi-list-ul me-2"></i> Mes clients</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownVentes" data-bs-toggle="dropdown">
                    <i class="bi bi-basket me-2"></i> Ventes
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownVentes">
                    <li><a class="dropdown-item" href="{{ route('ventes.crud') }}"><i class="bi bi-pencil-square me-2"></i> Gérer les ventes</a></li>
                    <li><a class="dropdown-item" href="{{ route('ventes.crud') }}"><i class="bi bi-list-ul me-2"></i> Mes ventes</a></li>
                </ul>
            </li>
                <a href="{{ route('produits.stocks.faibles') }}" class="nav-link text-white">
                    <i class="bi bi-clipboard-data me-2"></i> Stocks faibles
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile.show') }}" class="nav-link text-white">
                    <i class="bi bi-person me-2"></i> Mon profil
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                </a>
                <form id="logout-form" action="/logout" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Content - Nouvelle version -->
    <main class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Bienvenue, {{ Auth::user()->name }}</h3>
            <span class="badge bg-primary">{{ now()->format('l j F Y') }}</span>
        </div>

        <!-- Section Accès Rapide -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-lightning-charge"></i> Accès Rapide</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <a href="{{ route('ventes.create') }}" class="btn btn-primary quick-access-btn w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="bi bi-cart-plus quick-access-icon"></i>
                            <span>Nouvelle Vente</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('produits.crud') }}" class="btn btn-success quick-access-btn w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="bi bi-capsule quick-access-icon"></i>
                            <span>Gestion Stock</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('clients.crud') }}" class="btn btn-info quick-access-btn w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="bi bi-people quick-access-icon"></i>
                            <span>Gestion Clients</span>
                        </a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ route('produits.stocks.faibles') }}" class="btn btn-warning quick-access-btn w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="bi bi-exclamation-triangle quick-access-icon"></i>
                            <span>Stocks Faibles</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-success h-100 quick-access-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Produits en Stock</h5>
                            <h3>{{ $stats['produits'] ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-capsule-pill fs-1"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-info h-100 quick-access-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Ventes Aujourd'hui</h5>
                            <h3>{{ $stats['ventes_jour'] ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-cart-check fs-1"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-warning h-100 quick-access-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Alertes Stock</h5>
                            <h3>{{ $stats['alertes_stock'] ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-exclamation-triangle fs-1"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-danger h-100 quick-access-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Clients Actifs</h5>
                            <h3>{{ $stats['clients'] ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-people-fill fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dernières Ventes -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-receipt"></i> Dernières Transactions</h5>
            </div>
            <div class="card-body">
                @if(isset($dernieresVentes) && $dernieresVentes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
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
                    <div class="text-center py-3 text-muted">
                        <i class="bi bi-receipt-cutoff display-5"></i>
                        <p class="mt-2">Aucune transaction récente</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Produits en Alerte -->
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="bi bi-exclamation-triangle"></i> Produits en Alerte de Stock</h5>
            </div>
            <div class="card-body">
                @if(isset($alertesStock) && $alertesStock->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
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
                    <div class="text-center py-3 text-muted">
                        <i class="bi bi-check-circle display-5"></i>
                        <p class="mt-2">Aucun produit en alerte de stock</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

<!-- Bouton toggle sidebar sur mobile -->
<button class="sidebar-toggle-btn d-lg-none" aria-label="Toggle sidebar">
    <i class="bi bi-list"></i>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.querySelector('.sidebar-toggle-btn');

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        // Optionnel : Fermer sidebar quand on clique en dehors (sur mobile)
        document.addEventListener('click', function(event) {
            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target) && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    });
</script>
@endsection