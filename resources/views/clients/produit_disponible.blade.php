@extends('layouts.app')
@section('title', 'Liste des produits')
@section('content')

<div class="container mt-4">
    <h1 class="mb-3 text-center">Liste des Produits Disponibles</h1>

    <form class="d-flex mb-4" method="GET" action="{{ route('produit.disponible') }}">
        <input class="form-control me-2" type="search" name="recherche" value="{{ request('recherche') }}" placeholder="Rechercher un produit..." aria-label="Recherche">
        <button class="btn btn-outline-success" type="submit">Rechercher</button>
    </form>

    @if($produit->count() > 0)
        @foreach($produit as $categorie => $produits)
            <div class="categorie-section mb-5">
                <h2 class="categorie-title bg-light p-2 rounded">
                    {{ $categorie ?? 'Non catégorisé' }}
                </h2>
                
                <div class="row">
                    @foreach($produits as $produit)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produit->nom }}</h5>
                                    <p class="card-text">
                                        <strong>Prix:</strong> {{ number_format($produit->prix, 2) }} €<br>
                                        <strong>Stock:</strong> {{ $produit->quantite }}
                                    </p>
                                    <!-- Bouton Commander -->
                                    <form action="{{ route('commandes.commander_simple', $produit->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-success mt-2">
                                            Commander
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">Aucun produit disponible pour le moment.</p>
    @endif
</div>

@endsection