@extends('layout.app')

@section('title', 'Tableau de bord - Employé')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: white;
        }
        .sidebar a.active,
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
<div class="d-flex">
    {{-- Sidebar --}}
    <nav class="sidebar p-3 text-white">
        <h4 class="text-center mb-4"><i class="bi bi-shield-lock"></i> Employé</h4>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link text-white active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-white"><i class="bi bi-box-seam me-2"></i>Produits</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-white"><i class="bi bi-people me-2"></i>Clients</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-white"><i class="bi bi-currency-exchange me-2"></i>Commandes</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-white"><i class="bi bi-clipboard-data me-2"></i>Statistiques</a>
            </li>

            {{-- Dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="factureDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-file-earmark-medical me-2"></i>Factures
                </a>
                <ul class="dropdown-menu bg-dark border-0" aria-labelledby="factureDropdown">
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-person-circle me-2"></i>Délivrer une facture</a></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-shield-lock me-2"></i>Modifier</a></li>
                    <li><hr class="dropdown-divider bg-secondary"></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-sliders me-2"></i>Supprimer</a></li>
                </ul>
            </li>

            {{-- Déconnexion --}}
            <li class="nav-item">
                <a href="#" class="nav-link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    {{-- Main Content --}}
    <main class="p-4 w-100">
        <h3 class="mb-4">Bienvenue, {{ Auth::user()->name }}</h3>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-white bg-success h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Produits</h5>
                            <h3>5</h3>
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
                            <h3>15</h3>
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
                            <h3>20</h3>
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
                            <h3>1</h3>
                        </div>
                        <i class="bi bi-person-check fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection
