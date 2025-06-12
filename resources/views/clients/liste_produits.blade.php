@extends('layouts.app')
@section('title', 'Liste des produits disponibles')

@section('content')

<div class="container mt-4">
    <h1 class="mb-3 text-center">Liste des Produits Disponibles</h1>

    <form class="d-flex mb-4" method="GET" action="">
        <input class="form-control me-2" type="search" name="recherche" value="{{ request('recherche') }}" placeholder="Rechercher un produit..." aria-label="Recherche">
        <button class="btn btn-outline-success" type="submit">Rechercher</button>
    </form>

    @if($produits->count() > 0)
        <div class="row">
            @foreach($produits as $produit)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                             @if($produit->image)
                                 <img src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}">

                             @else
                        <img src="{{ asset('images/default.png') }}" alt="Image par défaut" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif
                            <h5 class="card-title">{{ $produit->nom }}</h5>
                            <p class="card-text">

                                <strong>Prix :</strong> {{ number_format($produit->prix, 2) }} €<br>
                                <strong>Stock :</strong> {{ $produit->quantite }}
                            </p>
                           @auth
                                <a href="{{ route('commandes.create', ['clientId' => auth()->user()->client->id, 'produitId' => $produit->id]) }}" class="btn btn-success mt-2">Commander</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-secondary mt-2">Se connecter pour commander</a>
                            @endauth
                </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $produits->links() }}
        </div>
    @else
        <p class="text-center">Aucun produit disponible pour le moment.</p>
    @endif
</div>

@endsection
