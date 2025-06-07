@extends('layouts.app')

@section('title', 'Alertes de stock faible')

@section('content')
<div class="container mt-4">
    <h4>Produits avec stock faible</h4>

    @if($produitsFaibles->isEmpty())
        <div class="alert alert-success">Tous les produits ont un stock suffisant.</div>
    @else
        <div class="alert alert-warning">Voici les produits avec un stock faible :</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom du produit</th>
                    <th>Quantité en stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produitsFaibles as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td class="text-danger fw-bold">{{ $produit->quantite }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
