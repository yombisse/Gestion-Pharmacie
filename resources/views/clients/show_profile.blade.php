@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-success">
                <div class="card-header bg-success text-white">
                    <h2 class="mb-0">Mon profile client</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        @if($client->user->avatar)
                        <div class="col-md-4 text-center mb-3">
                            <img src="{{ asset($client->user->avatar) }}" 
                                 alt="Photo de profil" 
                                 class="img-thumbnail rounded-circle border-success"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                        @else
                        <div class="col-12">
                        @endif
                            <div class="profile-details">
                                <p class="profile-item"><strong><i class="fas fa-user-tag mr-2"></i>Nom :</strong> {{ $client->nom }}</p>
                                <p class="profile-item"><strong><i class="fas fa-user mr-2"></i>Prénom :</strong> {{ $client->prenom }}</p>
                                <p class="profile-item"><strong><i class="fas fa-venus-mars mr-2"></i>Sexe :</strong> {{ ucfirst($client->sexe) }}</p>
                                <p class="profile-item"><strong><i class="fas fa-birthday-cake mr-2"></i>Date de naissance :</strong> {{ \Carbon\Carbon::parse($client->date_naissance)->format('d/m/Y') }}</p>
                                <p class="profile-item"><strong><i class="fas fa-phone mr-2"></i>Téléphone :</strong> {{ $client->telephone }}</p>
                                <p class="profile-item"><strong><i class="fas fa-map-marker-alt mr-2"></i>Adresse :</strong> {{ $client->adresse }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-success">
                            <i class="fas fa-edit mr-2"></i>Modifier le profil
                        </a>
                        <a href="{{ route('clients.dashboard') }}" class="btn btn-secondary ms-2">
                            <i class="fas fa-arrow-left mr-2"></i>Annuler
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-item {
        padding: 8px 0;
        border-bottom: 1px solid #eee;
        margin-bottom: 0;
    }

    .profile-item:last-child {
        border-bottom: none;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .border-success {
        border-width: 2px !important;
    }
</style>
@endsection
