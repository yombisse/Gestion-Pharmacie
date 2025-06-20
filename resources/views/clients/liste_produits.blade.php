<!--@extends('layouts.app')

@section('title', 'Liste des produits disponibles')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Liste des Produits Disponibles</h1>

     Formulaire de recherche 
    <form class="d-flex mb-4" method="GET" action="{{ route('produits.liste') }}">
        <input class="form-control me-2" type="search" name="recherche" value="{{ request('recherche') }}" placeholder="Rechercher un produit..." aria-label="Recherche">
        <button class="btn btn-outline-success" type="submit">Rechercher</button>
    </form>

    @if($produits->count() > 0)
        <div class="row">
            @foreach($produits as $produit)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($produit->image)
                            <img src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default.png') }}" alt="Image par défaut" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $produit->nom }}</h5>
                            <p class="card-text">
                                <strong>Prix :</strong> {{ number_format($produit->prix, 2) }} €<br>
                                <strong>Stock :</strong> {{ $produit->quantite }}
                            </p>

                            @auth
                                @if(Auth::user()->client)
                                    <a href="{{ route('commandes.create', ['produitId' => $produit->id]) }}" class="btn btn-success mt-auto">
                                        Commander
                                    </a>
                                @else
                                    <div class="alert alert-warning mt-auto mb-0">
                                        Aucun client associé à cet utilisateur.
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary mt-auto">
                                    Connectez-vous pour commander
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

         Pagination 
        <div class="d-flex justify-content-center">
            {{ $produits->links() }}
        </div>
    @else
        <p class="text-center">Aucun produit disponible pour le moment.</p>
    @endif
</div>
@endsection
-->
