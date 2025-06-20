<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pharmacie Dofiin Saamù')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        /* Supprime tout débordement horizontal */
        body {
            overflow-x: hidden;
        }
        .navbar {
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }
        .nav-link {
            transition: background-color 0.3s ease;
            border-radius: 0.3rem;
        }
        .nav-link:hover {
            background-color: rgba(255,255,255,0.15);
        }
        .dropdown-menu {
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border: none;
        }
        .dropdown-item:hover {
            background-color: rgba(0,0,0,0.05);
        }
        .user-info img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }
        /* Adaptation mobile */
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1rem;
            }
            .user-info img {
                width: 32px;
                height: 32px;
            }
            .user-info div.fw-bold {
                font-size: 0.85rem;
            }
            .user-info .badge {
                font-size: 0.7rem;
            }
            footer h5 {
                font-size: 1rem;
            }
            footer p, footer a {
                font-size: 0.85rem;
            }
            .nav-link {
                font-size: 0.9rem;
            }
        }
        /* Pour éviter que certains éléments prennent trop de largeur */
        .nav-item .dropdown-menu {
            min-width: 200px;
            word-wrap: break-word;
        }
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="bi bi-shield-lock"></i> 
            @if(Auth::user()->hasRole('admin'))
                Admin
            @else
                Personnel
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <i class="bi bi-list fs-4"></i>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Dashboard -->
                @if(Auth::user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('personnels.dashboard') }}" class="nav-link active">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard Personnel
                        </a>
                    </li>
                @endif

                <!-- Gestion des employés visible uniquement pour admin -->
                @if(Auth::user()->hasRole('admin'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-badge me-2"></i>Employés
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('personnels.crud') }}"><i class="bi bi-plus-circle me-2"></i>Gérer</a></li>
                            <li><a class="dropdown-item" href="{{ route('personnels.crud') }}"><i class="bi bi-list-ul me-2"></i>Mes employés</a></li>
                        </ul>
                    </li>
                @endif

                <!-- Stock -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-capsule me-2"></i>Stock
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('produits.crud') }}"><i class="bi bi-plus-circle me-2"></i>Gérer</a></li>
                        <li><a class="dropdown-item" href="{{ route('produits.crud') }}"><i class="bi bi-box-seam me-2"></i>Stock disponible</a></li>
                    </ul>
                </li>

                <!-- Clients -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-people me-2"></i>Clients
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('clients.crud') }}"><i class="bi bi-pencil-square me-2"></i>Gérer</a></li>
                        <li><a class="dropdown-item" href="{{ route('clients.crud') }}"><i class="bi bi-list-ul me-2"></i>Mes clients</a></li>
                    </ul>
                </li>

                <!-- Ventes -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-basket me-2"></i>Ventes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('ventes.crud') }}"><i class="bi bi-pencil-square me-2"></i>Gérer</a></li>
                        <li><a class="dropdown-item" href="{{ route('ventes.crud') }}"><i class="bi bi-list-ul me-2"></i>Mes ventes</a></li>
                    </ul>
                </li>

                <!-- Stocks faibles -->
                <li class="nav-item">
                    <a href="{{ route('produits.stocks.faibles') }}" class="nav-link">
                        <i class="bi bi-clipboard-data me-2"></i>Stocks faibles
                    </a>
                </li>
            </ul>

            <!-- Profil utilisateur -->
            <div class="d-flex align-items-center user-info ms-auto mt-3 mt-lg-0">
                @if(Auth::user()->avatar && file_exists(public_path(Auth::user()->avatar)))
                    <img src="{{ asset(Auth::user()->avatar) }}" class="rounded-circle me-2" alt="Avatar">
                @else
                    <img src="{{ asset('uploads/images/avatar.jpg') }}" class="rounded-circle me-2" alt="Avatar">
                @endif
                <div class="text-white me-3">
                    <div class="fw-bold">{{ Auth::user()->firstname }} {{ Auth::user()->name }}</div>
                    @if(Auth::user()->personnel)
                        <small class="badge bg-light text-success">{{ Auth::user()->personnel->poste }}</small>
                    @endif
                </div>
                <a href="#" class="btn btn-outline-light btn-sm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
            </div>

            <form id="logout-form" action="/logout" method="POST" class="d-none">@csrf</form>
        </div>
    </div>
</nav>

<!-- Contenu principal -->

    <div class="container-fluid">@yield('content')</div>


<!-- Footer -->
<footer class="py-4 bg-success text-white">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 mb-3">
                <h5>Pharmacie Dofiin Saamù</h5>
                <p><i class="bi bi-geo-alt me-2"></i> 123 Rue Principale</p>
                <p><i class="bi bi-telephone me-2"></i> +123 456 789</p>
                <p><i class="bi bi-envelope me-2"></i> contact@pharmacie.com</p>
            </div>
            <div class="col-sm-6 col-md-4 mb-3">
                <h5>Horaires</h5>
                <p>Lundi-Vendredi: 8h-20h</p>
                <p>Samedi: 9h-18h</p>
                <p>Dimanche: 10h-14h</p>
            </div>
            <div class="col-sm-12 col-md-4 mb-3">
                <h5>Réseaux sociaux</h5>
                <a href="#" class="text-white me-2"><i class="bi bi-facebook fs-4"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-twitter fs-4"></i></a>
                <a href="#" class="text-white me-2"><i class="bi bi-instagram fs-4"></i></a>
            </div>
        </div>
        <hr class="my-4 bg-light">
        <div class="text-center">
            &copy; 2025 Pharmacie Dofiin Saamù - Tous droits réservés.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
