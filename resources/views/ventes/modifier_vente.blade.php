@extends('layouts.app')

@section('title', 'Modifier la vente')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Modifier la vente</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('ventes.modifier', $vente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="produit_id" class="form-label">Produit</label>
                    <select name="produit_id" id="produit_id" class="form-select" required>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}" {{ $vente->produit_id == $produit->id ? 'selected' : '' }}>
                                {{ $produit->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantite_vente" class="form-label">Quantité vendue</label>
                    <input type="number" name="quantite_vente" id="quantite_vente" class="form-control"
                           value="{{ old('quantite_vente', $vente->quantite_vente) }}" required min="1">
                </div>

                <div class="mb-3">
                    <label for="client_nom" class="form-label">Nom du client</label>
                    <input type="text" name="client_nom" id="client_nom" class="form-control"
                           value="{{ old('client_nom', $vente->client_nom) }}" required>
                </div>

                <div class="mb-3">
                    <label for="date_vente" class="form-label">Date de vente</label>
                    <input type="date" name="date_vente" id="date_vente" class="form-control"
                           value="{{ old('date_vente', $vente->date_vente->format('Y-m-d')) }}" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('ventes.crud') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
