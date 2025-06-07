   
@extends('layouts.app')
@section('title', 'Facture-Vente')
@section('content')
       
   <style>
            body { font-family: Arial, sans-serif; font-size: 14px; }
            .facture { width: 100%; border: 1px solid #000; padding: 20px; }
            .header { text-align: center; margin-bottom: 20px; }
            .details { margin-bottom: 15px; }
    </style>
        <div class="facture">
            <div class="header">
                <h2>Facture de Vente</h2>
            </div>
            <div class="details">
                <p><strong>Client :</strong> {{ $vente->client_nom }}</p>
                <p><strong>Produit :</strong> {{ $vente->produit->nom ?? 'Produit supprimé' }}</p>
                <p><strong>Quantité :</strong> {{ $vente->quantite_vente }}</p>
                <p><strong>Prix total :</strong> {{ number_format($vente->prix_total, 2) }} FCFA</p>
                <p><strong>Date de vente :</strong> {{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}</p>
            </div>
            <p>Merci pour votre achat.</p>
        </div>
@endsection