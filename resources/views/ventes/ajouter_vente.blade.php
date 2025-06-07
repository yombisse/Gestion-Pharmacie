@extends('layouts.app')
@section('title', 'Ajouter une vente')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4>Nouvelle vente</h4>
        </div>

        <div class="card-body">
            <!-- Affichage des erreurs -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('ventes.store') }}" method="POST">
                @csrf

                <!-- Produit -->
                <div class="mb-3">
                    <label for="produit_id" class="form-label">Produit</label>
                    <select name="produit_id" id="produit_id" class="form-select" required>
                        <option value="">-- Sélectionner un produit --</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}" {{ old('produit_id') == $produit->id ? 'selected' : '' }}>
                                {{ $produit->nom }} (Stock: {{ $produit->quantite }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Quantité vendue -->
                <div class="mb-3">
                    <label for="quantite_vente" class="form-label">Quantité</label>
                    <input type="number" name="quantite_vente" id="quantite_vente" class="form-control" min="1" value="{{ old('quantite_vente') }}" required>
                </div>

                <!-- Client -->
                <div class="mb-3">
                    <label for="client_id" class="form-label">Client</label>
                    <select name="client_id" id="client_id" class="form-select" required>
                        <option value="">-- Sélectionner un client --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->nom }}  {{ $client->prenom }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date de la vente -->
                <div class="mb-3">
                    <label for="date_vente" class="form-label">Date de la vente</label>
                    <input type="date" name="date_vente" id="date_vente" class="form-control" value="{{ old('date_vente', date('Y-m-d')) }}" required>
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Enregistrer la vente</button>
                    <a href="{{ route('ventes.crud') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
