@extends('layouts.admin-navbar')
@section('title', 'Ajouter une vente')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4>Nouvelle vente</h4>
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

            <form action="{{ route('ventes.store') }}" method="POST">
                @csrf

                <!-- Commande associée -->
                <div class="mb-3">
                    <label for="commande_id" class="form-label">Commande associée </label>
                    <select name="commande_id" id="commande_id" class="form-select" required>
                        <option value="">-- Sélectionner une commande --</option>
                        @foreach($commandes as $commande)
                            <option 
                                value="{{ $commande->id }}" 
                                data-client="{{ $commande->client->id }}"
                                data-produits='@json($commande->produits)'
                            >
                                Commande #{{ $commande->id }} - {{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Sélectionner une commande pour remplir automatiquement les champs ci-dessous.</small>
                </div>

                <!-- Client -->
                <div class="mb-3">
                    <label for="client_id" class="form-label">Client</label>
                    <select name="client_id" id="client_id" class="form-select" required>
                        <option value="">-- Sélectionner un client --</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Produit -->
                <div class="mb-3">
                    <label for="produit_id" class="form-label">Produit</label>
                    <select name="produit_id" id="produit_id" class="form-select" required>
                        <option value="">-- Sélectionner un produit --</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}" data-stock="{{ $produit->quantite }}">
                                {{ $produit->nom }} (Stock: {{ $produit->quantite }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Quantité vendue -->
                <div class="mb-3">
                    <label for="quantite_vente" class="form-label">Quantité</label>
                    <input type="number" name="quantite_vente" id="quantite_vente" class="form-control" min="1" required>
                </div>

                <!-- Date de la vente -->
                <div class="mb-3">
                    <label for="date_vente" class="form-label">Date de la vente</label>
                    <input type="date" name="date_vente" id="date_vente" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Enregistrer la vente</button>
                    <a href="{{ route('ventes.crud') }}" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('commande_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const clientId = selectedOption.dataset.client;
    const produits = selectedOption.dataset.produits ? JSON.parse(selectedOption.dataset.produits) : [];

    // Met à jour le client
    document.getElementById('client_id').value = clientId;

    // Si la commande contient plusieurs produits, on prend le premier produit (par simplification ici)
    if (produits.length > 0) {
        document.getElementById('produit_id').value = produits[0].id;
        document.getElementById('quantite_vente').value = produits[0].pivot.quantite;
    } else {
        document.getElementById('produit_id').value = '';
        document.getElementById('quantite_vente').value = '';
    }
});
</script>
@endsection
