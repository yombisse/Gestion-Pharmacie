@extends('layouts.admin-navbar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Mon profil</h2>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        @if($personnel->photo)
                        <div class="col-md-4 text-center mb-3">
                            <img src="{{ asset($personnel->photo) }}" 
                                 alt="Photo de profil" 
                                 class="img-thumbnail rounded-circle border-primary"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                        @else
                        <div class="col-12">
                        @endif
                            <div class="profile-details">
                                <p class="profile-item"><strong><i class="fas fa-user-tag mr-2"></i>Nom :</strong> {{ $personnel->nom }}</p>
                                <p class="profile-item"><strong><i class="fas fa-user mr-2"></i>Prénom :</strong> {{ $personnel->prenom }}</p>
                                <p class="profile-item"><strong><i class="fas fa-venus-mars mr-2"></i>Sexe :</strong> {{ ucfirst($personnel->sexe) }}</p>
                                <p class="profile-item"><strong><i class="fas fa-birthday-cake mr-2"></i>Date de naissance :</strong> {{ \Carbon\Carbon::parse($personnel->date_naissance)->format('d/m/Y') }}</p>
                                <p class="profile-item"><strong><i class="fas fa-phone mr-2"></i>Téléphone :</strong> {{ $personnel->telephone }}</p>
                                <p class="profile-item"><strong><i class="fas fa-map-marker-alt mr-2"></i>Adresse :</strong> {{ $personnel->adresse }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                            <i class="fas fa-edit mr-2"></i>Modifier le profil
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
    
    .border-primary {
        border-width: 2px !important;
    }
</style>
@endsection