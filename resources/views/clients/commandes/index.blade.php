@extends('layouts.app')
@section('title', 'Mes commandes')
@section('content')

<div class="container mt-4">
    <h2>Mes Commandes</h2>

    @if ($commandes->isEmpty())
        <div class="alert alert-info text-center">
            Vous n'avez passé aucune commande pour le moment.
        </div>
    @else
        @foreach ($commandes as $commande)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between">
                    <span>Commande N° {{ $commande->id }}</span>
                    <span>Date : {{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</span>
                </div>

                <div class="card-body">
                    <h5>Produits commandés :</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Nom</th>
                                    <th>Prix Unitaire</th>
                                    <th>Quantité</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commande->produits as $produit)
                                    <tr>
                                        <td>{{ $produit->nom }}</td>
                                        <td>{{ number_format($produit->prix, 2) }} €</td>
                                        <td>{{ $produit->pivot->quantite }}</td>
                                        <td>{{ number_format($produit->pivot->quantite * $produit->prix, 2) }} €</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <strong>Statut :</strong> 
                        @if ($commande->statut === 'Validée')
                            <span class="badge bg-success">Validée</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ $commande->statut }}</span>
                        @endif
                    </div>

                    <div class="text-end mt-3">
                        @if ($commande->vente)
                            <a href="{{ route('ventes.facture', ['id' => $commande->vente->id]) }}" class="btn btn-outline-secondary">
                                Voir la facture
                            </a>
                        @else
                            <span class="text-muted">Facture non disponible</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('commandes.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-2"></i>Nouvelle commande
        </a>
        <a href="{{ route('clients.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Annuler
        </a>
    </div>
</div>

@endsection
