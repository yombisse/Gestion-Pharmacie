@extends('layouts.app')
@section('Commander')
@section('content')
<form action="{{ route('commandes.store') }}" method="POST">
    @csrf

    <!-- Client -->
    <input type="hidden" name="client_id" value="{{ $client->id }}">
    <div>
        <label>Client :</label>
        <input type="text" value="{{ $client->nom }}" disabled>
    </div>

    <!-- Date de commande -->
    <div class="mb-3">
            <label for="date_commande" class="form-label">Date de la commande</label>
            <input type="date" name="date_commande" id="date_commande" class="form-control"
            value="{{ old('date_commande', date('Y-m-d')) }}" required>
     </div>

    <!-- Produit -->
    <input type="hidden" name="produits[0][id]" value="{{ $produit->id }}">
    <div>
        <label>Produit :</label>
        <input type="text" value="{{ $produit->nom }}" disabled>
    </div>

    <!-- Quantité -->
    <div>
        <label>Quantité :</label>
        <input type="number" name="produits[0][quantite]" min="1" max="{{ $produit->quantite }}" required>
    </div>

    <button type="submit">Commander</button>
</form>
@endsection
