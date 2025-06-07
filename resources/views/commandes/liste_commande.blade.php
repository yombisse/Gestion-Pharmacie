@extends('layouts.app')
@section('title', 'Liste des commandes')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4>Commandes enregistrées</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($commandes->isEmpty())
                <p>Aucune commande enregistrée.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Produits</th>
                            <th>Total</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commandes as $commande)
                            <tr>
                                <td>{{ $commande->id }}</td>
                                <td>{{ $commande->client->nom ?? 'Inconnu' }}</td>
                                <td>{{ $commande->date_commande }}</td>
                                <td>
                                    <ul class="mb-0">
                                        @foreach($commande->produits as $produit)
                                            <li>
                                                {{ $produit->nom }} :
                                                {{ $produit->pivot->quantite }} × {{ number_format($produit->pivot->prix_unitaire, 2) }} = 
                                                {{ number_format($produit->pivot->sous_total, 2) }} F CFA
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td><strong>{{ number_format($commande->prix_total_commande, 2) }} F CFA</strong></td>
                                <td>{{ ucfirst($commande->statut) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
