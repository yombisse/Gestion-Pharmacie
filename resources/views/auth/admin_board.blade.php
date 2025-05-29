@extends('layout.app')

@section('title', 'Tableau de bord - Admin')

@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            height:auto;
            background-color: #343a40;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar a.active,
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar p-3 text-white">
        <h4 class="text-center mb-4"><i class="bi bi-shield-lock"></i> Admin</h4>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link text-white active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownEmployes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-badge me-2"></i> Employés
                </a>
                <ul class="dropdown-menu bg-dark border-0" aria-labelledby="dropdownEmployes">
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-plus-circle me-2"></i> Ajouter un employé</a></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-pencil-square me-2"></i> Modifier un employé</a></li>
                    <li><hr class="dropdown-divider bg-secondary"></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-trash me-2"></i> Supprimer un employé</a></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-list-ul me-2"></i> Mes employés</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownProduits" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-capsule me-2"></i> Produits
                </a>
                <ul class="dropdown-menu bg-dark border-0" aria-labelledby="dropdownProduits">
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-plus-circle me-2"></i> Ajouter un produit</a></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-pencil-square me-2"></i> Modifier un produit</a></li>
                    <li><hr class="dropdown-divider bg-secondary"></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-trash me-2"></i> Supprimer un produit</a></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-box-seam me-2"></i> Stock disponible</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownClients" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-people me-2"></i> Clients
                </a>
                <ul class="dropdown-menu bg-dark border-0" aria-labelledby="dropdownClients">
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-pencil-square me-2"></i> Modifier un client</a></li>
                    <li><hr class="dropdown-divider bg-secondary"></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-trash me-2"></i> Supprimer un client</a></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-list-ul me-2"></i> Mes clients</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownCommandes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-cart me-2"></i> Commandes
                </a>
                <ul class="dropdown-menu bg-dark border-0" aria-labelledby="dropdownCommandes">
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-check-circle me-2"></i> Valider une commande</a></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="bi bi-trash me-2"></i> Supprimer une commande</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link text-white"><i class="bi bi-clipboard-data me-2"></i>Statistiques</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-white"><i class="bi bi-person-lines-fill me-2"></i>Utilisateurs</a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                </a>
                <form id="logout-form" action="/logout" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="p-4 w-100">
        <h3 class="mb-4">Bienvenue, Michel</h3>

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