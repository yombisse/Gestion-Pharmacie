@extends('layouts.admin-navbar')

@section('title', 'Tableau de bord - Admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
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
@endsection

@section('scripts')
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Variables PHP passées à JS -->
    <script>
        const salesLabels = @json($salesLabels);
        const salesValues = @json($salesValues);
        const topProductsLabels = @json($topProductsLabels);
        const topProductsData = @json($topProductsData);
    </script>

    <!-- Script personnalisé -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection
