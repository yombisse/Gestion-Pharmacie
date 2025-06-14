@extends('layouts.app')
@section('title', 'Ajouter une commande')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4>Nouvelle commande</h4>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('commandes.store') }}" method="POST">
                @csrf

                <!-- Champ caché pour le client connecté -->
                <input type="hidden" name="client_id" value="{{ auth()->user()->client->id }}">

                <!-- Affichage en lecture seule du nom du client connecté -->
                <div class="mb-3">
                    <label class="form-label">Client</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->client->nom }} {{ auth()->user()->client->prenom }}" readonly>
                </div>

                <!-- Date de commande -->
                <div class="mb-3">
                    <label for="date_commande" class="form-label">Date de la commande</label>
                    <input type="date" name="date_commande" id="date_commande" class="form-control"
                           value="{{ old('date_commande', date('Y-m-d')) }}" required>
                </div>

                <!-- Liste des produits -->
                <div id="produits-container">
                    <div class="produit-row row mb-3">
                        <div class="col-md-7">
                            <label>Produit</label>
                            <select name="produits[0][id]" class="form-select" required>
                                <option value="">-- Choisir un produit --</option>
                                @foreach($produits as $produit)
                                    <option value="{{ $produit->id }}">
                                        {{ $produit->nom }} (Stock: {{ $produit->quantite }}, Prix: {{ $produit->prix }} FCFA)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Quantité</label>
                            <input type="number" name="produits[0][quantite]" class="form-control" min="1" required>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm remove-row">&times;</button>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-outline-secondary" id="add-produit">+ Ajouter un produit</button>
                </div>

                <!-- Boutons -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Enregistrer la commande</button>
                    <a href="{{ route('commandes.mes_commandes') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script JS -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let index = 1;
        const container = document.getElementById('produits-container');
        const addBtn = document.getElementById('add-produit');

        addBtn.addEventListener('click', () => {
            const row = document.createElement('div');
            row.classList.add('row', 'mb-3', 'produit-row');
            row.innerHTML = `
                <div class="col-md-7">
                    <select name="produits[${index}][id]" class="form-select" required>
                        <option value="">-- Choisir un produit --</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}">
                                {{ $produit->nom }} (Stock: {{ $produit->quantite }}, Prix: {{ $produit->prix }} FCFA)
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" name="produits[${index}][quantite]" class="form-control" min="1" required>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm remove-row">&times;</button>
                </div>
            `;
            container.appendChild(row);
            index++;
        });

        container.addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.produit-row').remove();
            }
        });
    });
</script>
@endsection
