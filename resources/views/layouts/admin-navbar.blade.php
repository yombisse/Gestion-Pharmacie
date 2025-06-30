<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Pharmacie Dofiin Saamù')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    @yield('styles')
   
</head>
<body>

<!-- Navbar Desktop (visible à partir de lg) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success navbar-desktop d-none d-lg-block">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-shield-lock me-2"></i>
            @if(Auth::user()->hasRole('admin')) Admin @else Personnel @endif
        </a>
        
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                @if(Auth::user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white nav-link-desktop">
                            <i class="bi bi-speedometer2 me-1"></i>Dashboard
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('personnels.dashboard') }}" class="nav-link text-white nav-link-desktop">
                            <i class="bi bi-speedometer2 me-1"></i>Dashboard
                        </a>
                    </li>
                @endif

                @if(Auth::user()->hasRole('admin'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white nav-link-desktop" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-person-badge me-1"></i>Employés
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('personnels.crud') }}"><i class="bi bi-plus-circle me-2"></i>Gérer</a></li>
                        <li><a class="dropdown-item" href="{{ route('personnels.crud') }}"><i class="bi bi-list-ul me-2"></i>Liste</a></li>
                    </ul>
                </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white nav-link-desktop" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-capsule me-1"></i>Stock
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('produits.crud') }}"><i class="bi bi-plus-circle me-2"></i>Gérer</a></li>
                        <li><a class="dropdown-item" href="{{ route('produits.crud') }}"><i class="bi bi-box-seam me-2"></i>Inventaire</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white nav-link-desktop" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-people me-1"></i>Clients
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('clients.crud') }}"><i class="bi bi-pencil-square me-2"></i>Gérer</a></li>
                        <li><a class="dropdown-item" href="{{ route('clients.crud') }}"><i class="bi bi-list-ul me-2"></i>Liste</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white nav-link-desktop" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-basket me-1"></i>Ventes
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('ventes.crud') }}"><i class="bi bi-pencil-square me-2"></i>Gérer</a></li>
                        <li><a class="dropdown-item" href="{{ route('ventes.crud') }}"><i class="bi bi-list-ul me-2"></i>Historique</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('produits.stocks.faibles') }}" class="nav-link text-white nav-link-desktop">
                        <i class="bi bi-exclamation-triangle me-1"></i>Stocks faibles
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white d-flex align-items-center user-dropdown-toggle" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-person-circle me-2 fs-5"></i>
                        <span class="d-none d-xl-inline">{{ Auth::user()->firstname }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="bi bi-person me-2"></i>Mon profil
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Navbar Mobile (visible jusqu'à lg) -->
<nav class="navbar navbar-dark bg-success navbar-mobile d-lg-none">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-shield-lock me-1"></i>
            @if(Auth::user()->hasRole('admin')) Admin @else Personnel @endif
        </a>
        <div class="d-flex align-items-center">
            <span class="text-white me-3 d-none d-sm-inline">
                {{ Auth::user()->firstname }}
            </span>
            <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminOffcanvas">
                <i class="bi bi-list fs-5"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Menu Offcanvas Mobile -->
<div class="offcanvas offcanvas-start text-bg-success" tabindex="-1" id="adminOffcanvas">
    <div class="offcanvas-header border-bottom border-light">
        <div>
            <h5 class="offcanvas-title fw-bold">
                <i class="bi bi-person-circle me-2"></i>
                {{ Auth::user()->firstname }} {{ Auth::user()->name }}
            </h5>
            <small class="text-white-50">{{ Auth::user()->email }}</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <ul class="navbar-nav flex-column">
            @if(Auth::user()->hasRole('admin'))
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white py-2">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('personnels.dashboard') }}" class="nav-link text-white py-2">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard Personnel
                    </a>
                </li>
            @endif

            @if(Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link text-white py-2" data-bs-toggle="collapse" href="#employeesCollapse">
                    <i class="bi bi-person-badge me-2"></i>Employés
                    <i class="bi bi-chevron-down float-end mt-1"></i>
                </a>
                <div class="collapse" id="employeesCollapse">
                    <ul class="nav flex-column ps-4">
                        <li class="nav-item">
                            <a href="{{ route('personnels.crud') }}" class="nav-link text-white py-2">
                                <i class="bi bi-plus-circle me-2"></i>Gérer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('personnels.crud') }}" class="nav-link text-white py-2">
                                <i class="bi bi-list-ul me-2"></i>Liste
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link text-white py-2" data-bs-toggle="collapse" href="#stockCollapse">
                    <i class="bi bi-capsule me-2"></i>Stock
                    <i class="bi bi-chevron-down float-end mt-1"></i>
                </a>
                <div class="collapse" id="stockCollapse">
                    <ul class="nav flex-column ps-4">
                        <li class="nav-item">
                            <a href="{{ route('produits.crud') }}" class="nav-link text-white py-2">
                                <i class="bi bi-plus-circle me-2"></i>Gérer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produits.crud') }}" class="nav-link text-white py-2">
                                <i class="bi bi-box-seam me-2"></i>Inventaire
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white py-2" data-bs-toggle="collapse" href="#clientsCollapse">
                    <i class="bi bi-people me-2"></i>Clients
                    <i class="bi bi-chevron-down float-end mt-1"></i>
                </a>
                <div class="collapse" id="clientsCollapse">
                    <ul class="nav flex-column ps-4">
                        <li class="nav-item">
                            <a href="{{ route('clients.crud') }}" class="nav-link text-white py-2">
                                <i class="bi bi-pencil-square me-2"></i>Gérer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('clients.crud') }}" class="nav-link text-white py-2">
                                <i class="bi bi-list-ul me-2"></i>Liste
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white py-2" data-bs-toggle="collapse" href="#salesCollapse">
                    <i class="bi bi-basket me-2"></i>Ventes
                    <i class="bi bi-chevron-down float-end mt-1"></i>
                </a>
                <div class="collapse" id="salesCollapse">
                    <ul class="nav flex-column ps-4">
                        <li class="nav-item">
                            <a href="{{ route('ventes.crud') }}" class="nav-link text-white py-2">
                                <i class="bi bi-pencil-square me-2"></i>Gérer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ventes.crud') }}" class="nav-link text-white py-2">
                                <i class="bi bi-list-ul me-2"></i>Historique
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="{{ route('produits.stocks.faibles') }}" class="nav-link text-white py-2">
                    <i class="bi bi-exclamation-triangle me-2"></i>Stocks faibles
                </a>
            </li>
        </ul>

        <div class="mt-auto pt-3 border-top border-light">
            <a href="{{ route('profile.show') }}" class="nav-link text-white py-2">
                <i class="bi bi-person me-2"></i>Mon profil
            </a>
            <a href="#" class="nav-link text-danger py-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
            </a>
             <form id="logout-form" action="/logout" method="POST" class="d-none">@csrf</form>
        </div>
    </div>
</div>

<!-- Contenu principal -->
<div class="container-fluid main-content">
    @yield('content')
</div>

<!-- Footer -->
<footer class="py-4 bg-success text-white mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h5 class="fw-bold mb-3">Pharmacie Dofiin Saamù</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i> 123 Rue Principale</li>
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i> +123 456 789</li>
                    <li><i class="bi bi-envelope me-2"></i> contact@pharmacie.com</li>
                </ul>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <h5 class="fw-bold mb-3">Horaires</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">Lundi-Vendredi: 8h-20h</li>
                    <li class="mb-2">Samedi: 9h-18h</li>
                    <li>Dimanche: 10h-14h</li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Réseaux sociaux</h5>
                <div class="d-flex">
                    <a href="#" class="text-white me-3 fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3 fs-5"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
        <hr class="my-4 bg-light opacity-50" />
        <div class="text-center">
            &copy; 2025 Pharmacie Dofiin Saamù - Tous droits réservés.
        </div>
    </div>
</footer>

<!-- Bootstrap Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>