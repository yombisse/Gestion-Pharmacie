@extends('layouts.admin-navbar')
@section('title', 'Liste des produits')
@section('content')

<div class="container mt-4">
    <h1 class="mb-3 text-center">Liste des Produits Disponibles</h1>

    <form class="d-flex mb-4" method="GET" action="{{ route('produits.liste') }}">
        <input class="form-control me-2" type="search" name="recherche" value="{{ request('recherche') }}" placeholder="Rechercher un produit..." aria-label="Recherche">
        <button class="btn btn-outline-success" type="submit">Rechercher</button>
    </form>

    @if($produits->count() > 0)
        <div class="row">
            @foreach($produits as $produit)
                @if($produit->eta)
                <div class="col-md-4 mb-4">
                    <div class="card h-100" style="width: 100%;">
                        <img src="{{ asset('storage/produits' . $produit->image) }}" alt="{{ $produit->nom }}" class="card-img-top">

                        <div class="card-body">
                            <h5 class="card-title">{{ $produit->nom }}</h5>
                            <p class="card-text">{{ Str::limit($produit->description, 100) }}</p>
                            <p><strong>Prix :</strong> {{ number_format($produit->prix, 2) }} FCFA</p>
                            <p><strong>Quantité :</strong> {{ $produit->quantite }}</p>
                            <p><strong>Catégorie :</strong> {{ $produit->categorie }}</p>
                        </div>
                        
                        <div class="card-body text-center">
                            <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-primary">Détails</a>
                            <a href="{{ route('commandes.commander',$produit->id) }}" class="btn btn-success">Commander</a>
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
