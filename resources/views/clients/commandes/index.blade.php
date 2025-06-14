@extends('layouts.app')

@section('title', 'Mes commandes')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Mes Commandes</h2>

    @if ($commandes->isEmpty())
        <div class="alert alert-info text-center">
            Vous n'avez passé aucune commande pour le moment.
        </div>
    @else
        @foreach ($commandes as $commande)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span>Commande N° {{ $commande->id }}</span>
                    <span>Date : {{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Produits commandés :</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered align-middle">
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
                    <div class="text-end mt-2">
                        <strong>Total commande :</strong>
                        {{ number_format($commande->produits->sum(function($produit) {
                            return $produit->pivot->quantite * $produit->prix;
                        }), 2) }} €
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
