@extends('layouts.admin-navbar')

@section('title', 'Tableau de bord - Admin')

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

    // Toggle sidebar mobile
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.querySelector('.sidebar-toggle-btn');
    const overlay = document.getElementById('sidebarOverlay');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
        document.body.classList.toggle('sidebar-open');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.classList.remove('sidebar-open');
    });

    // Close sidebar on window resize if desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth > 992) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        }
    });
});
</script>
@endsection