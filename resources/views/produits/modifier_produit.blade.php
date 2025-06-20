@extends('layouts.admin-navbar')
@section('title', 'Modifier le produit')
@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Modifier le produit</h2>

    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" value="{{ $produit->nom }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <input type="text" name="categorie" value="{{ $produit->categorie }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control">{{ $produit->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" step="0.01" name="prix" value="{{ $produit->prix }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" name="quantite" value="{{ $produit->quantite }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date_expiration" class="form-label">Date d’expiration</label>
            <input type="date" name="date_expiration" value="{{ $produit->date_expiration }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="eta" class="form-label">Disponible ?</label>
            <select name="eta" class="form-select">
                <option value="1" {{ $produit->eta ? 'selected' : '' }}>Oui</option>
                <option value="0" {{ !$produit->eta ? 'selected' : '' }}>Non</option>
            </select>
        </div>
        <div class="mb-3">
             <label for="photo" class="form-label">Photo</label>
             <input type="file" class="form-control" id="image" name="photo" accept="image/*">   
            @if($produit->image)
                        <div class="mt-2">
                            <img src="{{ asset($produit->image) }}" alt="Photo actuelle" class="img-thumbnail" width="100">
                            <p class="text-muted mt-1">Photo actuelle</p>
                        </div>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
</div>

@endsection
