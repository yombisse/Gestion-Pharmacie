@extends('layouts.app')
@section('title', 'Liste des produits')
@section('content')

<div class="container mt-4">
    <h1 class="mb-3 text-center">Liste des Produits Disponibles</h1>

    <!-- Bouton ajouter produit -->
    <div class="mb-3 text-end">
        <a href="{{ route('produits.create') }}" class="btn btn-success">+ Ajouter un produit</a>
    </div>

    <!-- Formulaire de recherche -->
    <form class="d-flex mb-4" method="GET" action="{{ route('produits.crud') }}">
        <input class="form-control me-2" type="search" name="recherche" value="{{ request('recherche') }}" placeholder="Rechercher un produit..." aria-label="Recherche">
        <button class="btn btn-outline-success" type="submit">Rechercher</button>
    </form>

    @if($produits->count() > 0)
        <div class="row">
            @foreach($produits as $produit)
                @if($produit->eta)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($produit->image)
                        <img src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}">

                        @else
                        <img src="{{ asset('images/default.png') }}" alt="Image par défaut" class="card-img-top" style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $produit->nom }}</h5>
                            <p class="card-text">{{ Str::limit($produit->description, 100) }}</p>
                            <p><strong>Prix :</strong> {{ number_format($produit->prix, 2) }} FCFA</p>
                            <p><strong>Quantité :</strong> {{ $produit->quantite }}</p>
                            <p><strong>Catégorie :</strong> {{ $produit->categorie }}</p>
                        </div>

                        <div class="card-body text-center">
                            <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-primary btn-sm">Détails</a>
                            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $produits->links() }}
        </div>
    @else
        <p class="text-center">Aucun produit disponible pour le moment.</p>
    @endif
</div>

@endsection
