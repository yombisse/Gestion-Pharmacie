@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mes Commandes</h2>
    
    @if($commandes->isEmpty())
        <div class="alert alert-info">Vous n'avez aucune commande.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Date</th>
                        <th>Produits</th>
                        <th>Total</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $commande)
                    <tr>
                        <td>#{{ $commande->id }}</td>
                        <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <ul>
                                @foreach($commande->produits as $produit)
                                <li>{{ $produit->nom }} (x{{ $produit->pivot->quantite }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ number_format($commande->total, 2) }} €</td>
                        <td>
                            <span class="badge bg-{{ $commande->statut == 'livré' ? 'success' : 'warning' }}">
                                {{ $commande->statut }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{ $commandes->links() }}
    @endif
</div>
@endsection