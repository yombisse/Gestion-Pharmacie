@extends('layout.app')

@section('title', 'Tableau de bord - Client')

@section('content')
    <style>
    body {
        margin: 0 !important; /* Ajouté */
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .wrapper {
        
        margin-left: 0 !important; /* Ajouté pour forcer l’annulation */
    }

    .sidebar {
        width: 250px;
        background-color: #0d6efd;
        color: white;
        min-height: 100vh;
        margin-left: 0 !important; /* Ajouté */
    }

    .sidebar .nav-link {
        color: white;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
        background-color: #0b5ed7;
    }

    .content {
        flex: 1;
        padding: 20px;
        background-color: #f8f9fa;
        margin-left: 0 !important; /* Au cas où une règle globale essaie de forcer un décalage */
    }
</style>


    <!-- Wrapper contenant la sidebar + contenu -->
    <div class="wrapper d-flex">

        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column p-3 bg-primary" style="min-width: 250px;margin: left 0;">
            <h5 class="text-center mb-4"><i class="bi bi-person-circle me-2"></i>  </h5>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="bi bi-bag-check me-2"></i>Mes commandes</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="bi bi-file-earmark-medical me-2"></i>Ordonnances</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="bi bi-clock-history me-2"></i>Historique</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="bi bi-question-circle me-2"></i>Support</a>
                </li>
                <li class="nav-item mt-3">
                    <a href="#" class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>

        <!-- Contenu principal -->
        <div class="content flex-fill p-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Bienvenue, </h4>
                        <i class="bi bi-person-circle fs-1 text-primary"></i>
                    </div>
                    <p class="card-text">Vous êtes désormais membre de notre pharmacie en ligne.</p>

                    <hr>
                    <h5>Informations de profil</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-person-fill me-2"></i>Nom : </li>
                        <li class="list-group-item"><i class="bi bi-person-fill me-2"></i> </li>
                        <li class="list-group-item"><i class="bi bi-envelope-fill me-2"></i>Email : </li>
                    </ul>

                    <div class="mt-4">
                        <a href="#" class="btn btn-success"><i class="bi bi-cart-plus me-2"></i>Passer une commande</a>
                        <a href="#" class="btn btn-outline-secondary"><i class="bi bi-pencil-square me-2"></i>Modifier mon profil</a>
                    </div>

                    @if(session('status'))
                        <div class="alert alert-danger mt-4">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

   

@endsection
