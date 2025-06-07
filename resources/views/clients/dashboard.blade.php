@extends('layouts.app')

@section('title', 'Tableau de bord - Client')

@section('content')
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }

        .wrapper {
            display: flex;
            flex: 1;
            margin-top: 56px; /* Compensation pour la navbar */
        }

        .sidebar {
            width: 250px;
            background-color: #0d6efd;
            color: white;
            min-height: calc(100vh - 56px);
            position: fixed;
            left: 0;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #0b5ed7;
        }

        .content {
            flex: 1;
            padding: 20px;
            margin-left: 250px; /* Largeur de la sidebar */
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>

    <!-- Wrapper contenant la sidebar + contenu -->
    <div class="wrapper">

        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column p-3">
            <h5 class="text-center mb-4">
                <i class="bi bi-person-circle me-2"></i> 
                {{ Auth::user()->firstname }} {{ Auth::user()->name }}
            </h5>
            <ul class="nav nav-pills flex-column">
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
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Bienvenue, {{ Auth::user()->firstname }}</h4>
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
                        <a href="{{ route('commandes.create') }}" class="btn btn-success">
                            <i class="bi bi-cart-plus me-2"></i>Passer une commande
                        </a>
                        <a href="{{ route('client.editProfile') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-pencil-square me-2"></i>Modifier mon profil
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

    <script>
        // Pour le responsive
        document.addEventListener('DOMContentLoaded', function() {
            function handleResize() {
                const sidebar = document.querySelector('.sidebar');
                const content = document.querySelector('.content');
                
                if (window.innerWidth < 768) {
                    sidebar.style.position = 'relative';
                    content.style.marginLeft = '0';
                } else {
                    sidebar.style.position = 'fixed';
                    content.style.marginLeft = '250px';
                }
            }
            
            window.addEventListener('resize', handleResize);
            handleResize(); // Appel initial
        });
    </script>
@endsection