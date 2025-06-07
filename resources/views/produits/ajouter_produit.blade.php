@extends('layouts.app')
@section('title', 'Ajouter un produit')
@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Ajouter un nouveau produit</h2>

    <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom du produit</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <input type="text" name="categorie" id="categorie" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix (FCFA)</label>
            <input type="number" name="prix" id="prix" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date_expiration" class="form-label">Date d’expiration</label>
            <input type="date" name="date_expiration" id="date_expiration" class="form-control">
        </div>

        <div class="mb-3">
            <label for="eta" class="form-label">Disponible ?</label>
            <select name="eta" id="eta" class="form-select">
                <option value="1" selected>Oui</option>
                <option value="0">Non</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image du produit</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

@endsection
