<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pharmacie Dofiin Saamù')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS personnalisé -->
    @stack('styles')

</head>
<body>

    {{-- Navbar Bootstrap --}}
    <nav class="navbar navbar-expand-lg bg-success">
        <div class="container-fluid">
             <img src="{{ asset('images/logo.png') }}" alt="Logo Pharmacie" width="50">
            <a style="margin-left: 5px;" class="navbar-brand text-white" href="#">    Pharmacie</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/register') }}">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/login') }}">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/profile') }}">Profil</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Recherche</button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Contenu principal --}}
    <div class="container-fluid mt-4">
        @yield('content')
    </div>

    {{-- Footer (optionnel) --}}
    <footer class="bg-primary text-white text-center py-3 mt-5">
        &copy; 2025 Pharmacie Dofiin Saamù - Tous droits réservés.
    </footer>

    {{-- Scripts Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Zone d'injection de scripts personnalisés --}}
    @stack('scripts')

</body>
</html>
