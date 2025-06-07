@extends('layouts.app')

@section('title', 'Tableau de bord - Admin')

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
        margin-top: 56px;
    }
    .sidebar {
        width: 250px;
        background-color: #343a40;
        color: white;
        position: fixed;
        top: 56px;
        bottom: 0;
        left: 0;
        overflow-y: auto;
        z-index: 0;
        transition: all 0.3s;
    }
    .sidebar-content {
        padding: 20px;
    }
    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 8px 0;
    }
    .sidebar a.active,
    .sidebar a:hover {
        background-color: #495057;
    }
    .main-content {
        flex: 1;
        margin-left: 250px;
        padding: 20px;
        min-height: calc(100vh - 56px);
    }
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
    @media (max-width: 992px) {
        .sidebar {
            margin-left: -250px;
        }
        .sidebar.active {
            margin-left: 0;
        }
        .main-content {
            margin-left: 0;
        }
    }
</style>

<div class="admin-container">
    <!-- Sidebar -->
    <nav class="sidebar p-3 text-white">
        <h4 class="text-center mb-3"><i class="bi bi-shield-lock"></i> Espace Admin</h4>
        <div class="text-center mb-3">
            <img src="{{ asset( Auth::user()->avatar) }}" class="rounded-circle" width="60" height="60" alt="Avatar" >
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
                <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownEmployes" data-bs-toggle="dropdown">
                    <i class="bi bi-person-badge me-2"></i> Employés
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownEmployes">
                    <li><a class="dropdown-item" href="{{ route('personnels.crud') }}"><i class="bi bi-plus-circle me-2"></i> Gérer</a></li>
                    <li><a class="dropdown-item" href="{{ route('personnels.crud') }}"><i class="bi bi-list-ul me-2"></i> Mes employés</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownProduits" data-bs-toggle="dropdown">
                    <i class="bi bi-capsule me-2"></i> Produits Pharmaceutiques
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

            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownCommandes" data-bs-toggle="dropdown">
                    <i class="bi bi-cart me-2"></i> Commandes
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownCommandes">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2"></i> Valider une commande</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-trash me-2"></i> Supprimer une commande</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('produits.stocks.faibles') }}" class="nav-link text-white">
                    <i class="bi bi-clipboard-data me-2"></i> Stocks faibles
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link text-white">
                    <i class="bi bi-graph-up-arrow me-2"></i> Voir les statistiques
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link text-white">
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

    <!-- Main Content -->
    <main class="main-content">
        <h3 class="mb-4">Bienvenue, {{ Auth::user()->name }}</h3>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-success h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Produits</h5>
                            <h3>{{ $productCount ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-capsule-pill fs-1"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-info h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Commandes</h5>
                            <h3>{{ $orderCount ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-cart-check fs-1"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Clients</h5>
                            <h3>{{ $clientCount ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-people-fill fs-1"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-danger h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Utilisateurs</h5>
                            <h3>{{ $userCount ?? 0 }}</h3>
                        </div>
                        <i class="bi bi-person-check fs-1"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section des graphiques -->
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Ventes mensuelles</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlySalesChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Top 5 des produits</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="topProductsChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ventes mensuelles
    const salesCtx = document.getElementById('monthlySalesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: @json($salesLabels),
            datasets: [{
                label: 'Ventes (€)',
                data: @json($salesValues),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                tension: 0.3
            }]
        },
        options: {
            responsive: true
        }
    });

    // Produits les plus vendus
    const topCtx = document.getElementById('topProductsChart').getContext('2d');
    new Chart(topCtx, {
        type: 'bar',
        data: {
            labels: @json($topProductsLabels),
            datasets: [{
                label: 'Quantité vendue',
                data: @json($topProductsData),
                backgroundColor: 'rgba(40, 167, 69, 0.6)',
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
});
</script>
@endsection
