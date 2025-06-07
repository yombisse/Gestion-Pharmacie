@extends('layouts.app')

@section('title', 'Détails du produit')

@section('content')
<div class="container mt-4">
    <div class="card mb-3">
       

        <div class="card-body">
            
            <p class="card-text text-center"><strong>Nom :</strong> {{ $user->client->nom }}</p>
            <p class="card-text text-center"><strong>Prénom :</strong> {{ $user->client->prenom }}</p>
            <p class="card-text text-center"><strong>Sexe :</strong> {{ $user->client->sexe  }} </p>
            <p class="card-text text-center"><strong>Téléphone :</strong> {{ $user->client->telephone }}</p>
            <p class="card-text text-center"><strong>Adresse :</strong> {{ $user->client->adresse}}</p>
            <a href="{{ route('produits.crud') }}" class="btn btn-secondary text-center">Retour</a>
        </div>
    </div>
</div>
@endsection
