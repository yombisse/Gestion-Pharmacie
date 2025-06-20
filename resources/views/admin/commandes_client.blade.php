@extends('layouts.app')

@section('title', 'Gestion Commande')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Commandes en Cours</h2>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($commandes->isEmpty())
                <div class="alert alert-info">
                    Aucune commande en attente ou en cours de traitement pour le moment.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID Commande</th>
                                <th>Client</th>
                                <th>Date Commande</th>
                                <th>Statut</th>
                                <th>Total</th>
                                <th>Articles</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commandes as $commande)
                                <tr>
                                    <td>{{ $commande->id }}</td>
                                    <td>
                                        @if($commande->client)
                                            <strong>{{ $commande->client->nom }}</strong><br>
                                            <small class="text-muted">{{ $commande->client->email }}</small>
                                        @elseif($commande->user)
                                            <strong>{{ $commande->user->name }}</strong><br>
                                            <small class="text-muted">{{ $commande->user->email }}</small>
                                        @else
                                            <span class="text-muted">Client anonyme</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($commande->statut == 'en_attente') badge-warning
                                            @elseif($commande->statut == 'en_preparation') badge-info
                                            @elseif($commande->statut == 'expediee') badge-primary
                                            @elseif($commande->statut == 'livree') badge-success
                                            @elseif($commande->statut == 'annulee') badge-danger
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                        </span>
                                    </td>
                                    <td class="font-weight-bold">{{ number_format($commande->prix_total_commande, 2, ',', ' ') }} F CFA</td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($commande->produits as $produit)
                                                <li class="mb-1">
                                                    <span class="badge badge-light">{{ $produit->pivot->quantite }} x</span>
                                                    {{ $produit->nom }} 
                                                    <small class="text-muted">
                                                        @ {{ number_format($produit->pivot->prix_unitaire, 2, ',', ' ') }} F CFA
                                                    </small>
                                                    <span class="d-block text-right">
                                                        <small>{{ number_format($produit->pivot->sous_total, 2, ',', ' ') }} F CFA</small>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{ route('admin.commandes.update_status', $commande->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group mb-0">
                                                <select name="statut" class="form-control form-control-sm" onchange="this.form.submit()">
                                                    <option value="en_attente" {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                                    <option value="livree" {{ $commande->statut == 'livree' ? 'selected' : '' }}>Livrée</option>
                                                    <option value="annulee" {{ $commande->statut == 'annulee' ? 'selected' : '' }}>Annulée</option>
                                                </select>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $commandes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection