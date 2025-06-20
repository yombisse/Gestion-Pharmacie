@extends('layouts.app')

@section('title', 'Tableau de bord - Client')

@section('content')


    <!-- Contenu principal -->
    <div class="content">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <h4 class="card-title mb-2">Bienvenue, {{ Auth::user()->firstname }}</h4>
                     
                    @if(Auth::user()->avatar && file_exists(public_path(Auth::user()->avatar)))
                        <img src="{{ asset(Auth::user()->avatar) }}" class="rounded-circle" width="60" height="60" alt="Avatar">
                    @else
                        <img src="{{ asset('uploads/images/avatar.jpg') }}" class="rounded-circle" width="60" height="60" alt="Avatar par défaut">
                    @endif
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
                    <a href="{{ route('produits.liste') }}" class="btn btn-success me-2 mb-2">
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
