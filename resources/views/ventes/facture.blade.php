@extends('layouts.app')
@section('title', 'Facture-Vente')
@section('content')

<div class="container mt-4">
    <div class="card border-primary shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center mb-0"><i class="bi bi-receipt"></i> Facture de Vente</h3>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5 class="text-primary">Informations client</h5>
                    <hr class="my-2">
                    <p><strong><i class="bi bi-person"></i> Client :</strong>{{ $vente->client->prenom }} {{ $vente->client->nom }}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5 class="text-primary">Détails facture</h5>
                    <hr class="my-2">
                    <p><strong><i class="bi bi-calendar"></i> Date :</strong> {{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Produit</th>
                            <th class="text-end">Quantité</th>
                            <th class="text-end">Prix unitaire</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $vente->produit->nom ?? 'Produit supprimé' }}</td>
                            <td class="text-end">{{ $vente->quantite_vente }}</td>
                            <td class="text-end">{{ number_format($vente->prix_total / $vente->quantite_vente, 2) }} FCFA</td>
                            <td class="text-end fw-bold">{{ number_format($vente->prix_total, 2) }} FCFA</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="table-active">
                            <td colspan="3" class="text-end fw-bold">Total à payer</td>
                            <td class="text-end fw-bold">{{ number_format($vente->prix_total, 2) }} FCFA</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> Merci pour votre confiance. Pour toute réclamation, veuillez contacter notre service client.
            </div>
        </div>
        
        <div class="card-footer text-muted text-center">
            Facture générée le {{ now()->format('d/m/Y à H:i') }}
        </div>
    </div>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
        <button onclick="window.print()" class="btn btn-outline-primary me-md-2">
            <i class="bi bi-printer"></i> Imprimer
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card, .card * {
            visibility: visible;
        }
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
            box-shadow: none;
        }
        .no-print {
            display: none !important;
        }
    }
</style>

@endsection