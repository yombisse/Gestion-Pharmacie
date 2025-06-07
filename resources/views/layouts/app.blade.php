<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pharmacie Dofiin Saamù')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSS personnalisé -->
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content {
            flex: 1;
        }
        .navbar-brand {
            font-weight: 600;
        }
        footer {
            background-color: green;
            z-index: 1000;
        }
        .nav-link.active {
            font-weight: 500;
            text-decoration: underline;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
        <div class="container">
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50" class="me-2">
                <a class="navbar-brand" href="{{ url('/') }}">Pharmacie Dofiin Saamù</a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        @auth
                            @php $user = Auth::user(); @endphp

                            @if ($user->hasRole('admin'))
                                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-house-door me-1"></i> Accueil
                                </a>
                            @elseif ($user->hasRole('personnel'))
                                <a class="nav-link {{ request()->is('personnel/dashboard') ? 'active' : '' }}" href="{{ route('personnels.dashboard') }}">
                                    <i class="bi bi-house-door me-1"></i> Accueil
                                </a>
                            @elseif ($user->hasRole('client'))
                                <a class="nav-link {{ request()->is('client/dashboard') ? 'active' : '' }}" href="{{ route('clients.dashboard') }}">
                                    <i class="bi bi-house-door me-1"></i> Accueil
                                </a>
                            @else
                                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                    <i class="bi bi-house-door me-1"></i> Accueil
                                </a>
                            @endif
                        @else
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                <i class="bi bi-house-door me-1"></i> Accueil
                            </a>
                        @endauth
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="#">
                                <i class="bi bi-person me-1"></i> Profil
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{ url('/register') }}">
                                <i class="bi bi-person-plus me-1"></i> Inscription
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ url('/login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                            </a>
                        </li>
                    @endauth
                </ul>

                <form class="d-flex" action="#" method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" name="q" placeholder="Recherche..." aria-label="Search">
                        <button class="btn btn-light" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                @auth
                <ul class="navbar-nav ms-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Mon compte</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="main-content py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4 bg-success text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>Pharmacie Dofiin Saamù</h5>
                    <p class="mb-1"><i class="bi bi-geo-alt me-2"></i> Adresse: 123 Rue Principale</p>
                    <p class="mb-1"><i class="bi bi-telephone me-2"></i> Tél: +123 456 789</p>
                    <p><i class="bi bi-envelope me-2"></i> Email: contact@pharmacie.com</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Horaires</h5>
                    <p class="mb-1">Lundi-Vendredi: 8h-20h</p>
                    <p class="mb-1">Samedi: 9h-18h</p>
                    <p>Dimanche: 10h-14h</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Réseaux sociaux</h5>
                    <div class="social-icons">
                        <a href="#" class="text-white me-2"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#" class="text-white me-2"><i class="bi bi-twitter fs-4"></i></a>
                        <a href="#" class="text-white me-2"><i class="bi bi-instagram fs-4"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                &copy; 2025 Pharmacie Dofiin Saamù - Tous droits réservés.
            </div>
        </div>
    </footer>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts personnalisés -->
    <script>
        // Active le dropdown au hover pour les écrans larges
        if (window.innerWidth > 992) {
            document.querySelectorAll('.navbar .dropdown').forEach(function(element) {
                element.addEventListener('mouseover', function() {
                    this.querySelector('.dropdown-toggle').click();
                });
                element.addEventListener('mouseout', function() {
                    this.querySelector('.dropdown-toggle').click();
                });
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
