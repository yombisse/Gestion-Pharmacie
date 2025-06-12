@extends('layouts.app')

@section('title', 'Détail de la vente')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="row g-0">
                    @if($vente->produit && $vente->produit->image)
                    <div class="col-md-4">
                        <img src="{{ asset( $vente->produit->image) }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="Produit">
                    </div>
                    @endif

                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">Vente #{{ $vente->id }}</h3>

                            <p class="card-text mb-1"><strong>Produit :</strong> {{ $vente->produit->nom ?? 'Non spécifié' }}</p>
                            <p class="card-text mb-1"><strong>Quantité vendue :</strong> {{ $vente->quantite_vente }}</p>
                            <p class="card-text mb-1"><strong>Prix total :</strong> {{ number_format($vente->prix_total, 0, ',', ' ') }} FCFA</p>
                            
                            @if($vente->client_nom)
                               <p><strong><i class="bi bi-person"></i> Client :</strong>{{ $vente->client->prenom }} {{ $vente->client->nom }}</p>
                           @else
                                <p class="card-text mb-1"><strong>Client :</strong> Non spécifié</p>
                            @endif

                            <p class="card-text mb-1"><strong>Date de vente :</strong> {{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}</p>
                            <p class="card-text mb-1"><strong>Créée le :</strong> {{ $vente->created_at->format('d/m/Y à H:i') }}</p>

                            <div class="mt-3">
                                <a href="{{ route('ventes.crud') }}" class="btn btn-outline-secondary">Retour à la liste</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
@endsection
