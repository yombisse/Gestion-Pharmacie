@extends('layouts.admin-navbar')
@section('title', 'Liste des ventes')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Liste des ventes</h4>
            <a href="{{ route('ventes.create') }}" class="btn btn-light btn-sm">+ Ajouter une vente</a>
        </div>

        <div class="card-body">
            <!-- Message de succès -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Conteneur overflow uniquement pour le tableau -->
            <div style="overflow-x: auto;">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-secondary text-center">
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix total</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ventes as $vente)
                            <tr>
                                <td>{{ $vente->produit->nom ?? 'Produit supprimé' }}</td>
                                <td class="text-center">{{ $vente->quantite_vente }}</td>
                                <td>{{ number_format($vente->prix_total, 2) }} FCFA</td>
                                <td>{{ $vente->client_nom }}</td>
                                <td>{{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('ventes.show', $vente->id) }}" class="btn btn-info btn-sm">Voir</a>
                                    <a href="{{ route('ventes.edit', $vente->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <a href="{{ route('ventes.facture', $vente->id) }}" class="btn btn-secondary btn-sm">Facture</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Aucune vente enregistrée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $ventes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
