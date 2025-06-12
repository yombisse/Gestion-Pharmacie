@extends('layouts.app')

@section('title', 'Tableau de bord - Client')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
    }

    .wrapper {
        display: flex;
        margin-top: 56px; /* hauteur de la navbar */
        min-height: calc(100vh - 56px);
    }

    .sidebar {
        width: 250px;
        background-color: #0d6efd;
        color: white;
        padding: 20px 15px;
        position: fixed;
        top: 56px;
        left: 0;
        bottom: 0;
        overflow-y: auto;
    }

    .sidebar .nav-link {
        color: white;
        padding: 10px 15px;
        margin-bottom: 5px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
        background-color: #0b5ed7;
    }

    .content {
        margin-left: 250px;
        padding: 20px;
        width: 100%;
    }

    @media (max-width: 768px) {
        .wrapper {
            flex-direction: column;
        }

        .sidebar {
            position: relative;
            width: 100%;
            top: 0;
            min-height: auto;
        }

        .content {
            margin-left: 0;
        }
    }
</style>

<div class="wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <h5 class="text-center mb-4">
            <i class="bi bi-person-circle me-2"></i>
            {{ Auth::user()->firstname }} {{ Auth::user()->name }}
        </h5>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('commandes.index') }}" class="nav-link">
                    <i class="bi bi-bag-check me-2"></i> Mes commandes
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile.show') }}" class="nav-link">
                    <i class="bi bi-file-earmark-medical me-2"></i> Mon profil
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-clock-history me-2"></i> Historique
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-question-circle me-2"></i> Support
                </a>
            </li>
            <li class="nav-item mt-3">
                <a href="#" class="nav-link text-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <!-- Contenu principal -->
    <div class="content">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <h4 class="card-title mb-2">Bienvenue, {{ Auth::user()->firstname }}</h4>
                    <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.png') }}"
                         class="rounded-circle" width="60" height="60" alt="Avatar">
                </div>

                <p class="card-text">Vous êtes désormais membre de notre pharmacie en ligne.</p>

                <hr>
                <h5>Informations de profil</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="bi bi-person-fill me-2"></i>Nom : {{ Auth::user()->name }}
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-person-fill me-2"></i>Prénom : {{ Auth::user()->firstname }}
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-envelope-fill me-2"></i>Email : {{ Auth::user()->email }}
                    </li>
                </ul>

                <div class="mt-4">
                    <a href="{{ route('produit.liste') }}" class="btn btn-success me-2 mb-2">
                        <i class="bi bi-cart-plus me-2"></i>Voir les produits disponibles
                    </a>
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
