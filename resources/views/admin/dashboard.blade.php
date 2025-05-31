<x-layouts.app>
    <x-slot name="header">
        <h2>Tableau de bord - Admin</h2>
    </x-slot>

    @push('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            height: auto;
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
    @endpush

    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar p-3 text-white">
            <h4 class="text-center mb-4"><i class="bi bi-shield-lock"></i> Admin</h4>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link text-white active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                </li>
                <!-- Autres éléments de menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownEmployes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-badge me-2"></i> Employés
                    </a>
                    <ul class="dropdown-menu bg-dark border-0" aria-labelledby="dropdownEmployes">
                        <li><a class="dropdown-item text-white" href="/ajouter"><i class="bi bi-plus-circle me-2"></i> Ajouter un employé</a></li>
                        <li><a class="dropdown-item text-white" href="#"><i class="bi bi-pencil-square me-2"></i> Modifier un employé</a></li>
                        <li><hr class="dropdown-divider bg-secondary"></li>
                        <li><a class="dropdown-item text-white" href="/employes/supprimer"><i class="bi bi-trash me-2"></i> Supprimer un employé</a></li>
                        <li><a class="dropdown-item text-white" href="/employes"><i class="bi bi-list-ul me-2"></i> Mes employés</a></li>
                    </ul>
                </li>
                <!-- Ajoute les autres sections (Produits, Clients, etc.) de la même façon -->
            </ul>
        </nav>

        <!-- Main Content -->
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
                <!-- Autres cards (Commandes, Clients, Utilisateurs) ici -->
            </div>
        </main>
    </div>
</x-layouts.app>
