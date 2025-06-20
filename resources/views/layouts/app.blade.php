<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Pharmacie Dofiin Saamù - Client')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex-grow: 1;
            padding: 1rem;
        }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="40" class="me-2" />
            Pharmacie Dofiin Saamù
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#clientNavbar"
            aria-controls="clientNavbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="clientNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->is('client/dashboard') ? 'active' : '' }}"
                        href="{{ route('clients.dashboard') }}"
                    >
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->is('client/commandes*') ? 'active' : '' }}"
                        href="{{ route('commandes.mes_commandes') }}"
                    >
                        <i class="bi bi-bag-check me-1"></i> Mes commandes
                    </a>
                </li>
                
                <li class="nav-item">
                    <a
                        class="nav-link {{ request()->is('client/profile') ? 'active' : '' }}"
                        href="{{ route('profile.show') }}"
                    >
                        <i class="bi bi-file-earmark-medical me-1"></i> Mon profil
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle d-flex align-items-center"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="bi bi-person-circle me-1"></i>
                        {{ Auth::user()->firstname }} {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="bi bi-person me-2"></i> Mon compte
                            </a>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
