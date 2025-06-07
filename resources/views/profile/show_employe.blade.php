@extends('layouts.app')

@section('title', 'Profil de l\'employé')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="row g-0">
                    @if($user->personnel->photo)
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $user->personnel->photo) }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="Photo de l'employé">
                    </div>
                    @endif
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">{{ $user->personnel->nom }} {{  $user->personnel->prenom }}</h3>
                            <p class="card-text mb-1"><strong>Identifiant :</strong> #{{ $user->personnel->id }}</p>
                            <p class="card-text mb-1"><strong>Sexe :</strong> {{ ucfirst($user->personnel->sexe) }}</p>
                            <p class="card-text mb-1"><strong>Email :</strong> {{ $user->personnel->email }}</p>
                            <p class="card-text mb-1"><strong>Adresse :</strong> {{ $user->personnel->adresse }}</p>
                            <p class="card-text mb-1"><strong>Téléphone :</strong> {{ $user->personnel->telephone }}</p>
                            <p class="card-text mb-1"><strong>Poste :</strong> {{ $user->personnel->poste }}</p>
                            <p class="card-text mb-1"><strong>Salaire :</strong> {{ number_format($user->personnel->salaire, 2) }} FCFA</p>
                            <p class="card-text mb-1"><strong>Date de naissance :</strong> {{ \Carbon\Carbon::parse($user->personnel->date_naissance)->format('d/m/Y') }}</p>
                            <p class="card-text mb-3"><strong>Date d'embauche :</strong> {{ \Carbon\Carbon::parse($user->personnel->date_emploi)->format('d/m/Y') }}</p>
                            <p class="card-text">
                                <strong>État :</strong>
                                @if($user->personnel->etat)
                                    <span class="badge bg-success">Actif</span>
                                @else
                                    <span class="badge bg-danger">Inactif</span>
                                @endif
                            </p>
                            <div class="mt-3">
                                <a href="{{ route('personnels.crud') }}" class="btn btn-outline-secondary">Retour à la liste</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
@endsection
