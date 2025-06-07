@extends('layouts.app')

@section('title', 'Profil de l\'employé')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="row g-0">
                    <!-- Avatar -->
                    <div class="col-md-4 bg-light d-flex align-items-center justify-content-center p-3">
                        <img src="{{ asset($personnel->photo ?? 'uploads/images/avatar.jpg') }}"
                             class="img-fluid rounded-circle shadow"
                             alt="Photo de l'employé"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <!-- Infos -->
                    <div class="col-md-8">
                        <div class="card-body px-4 py-4">
                            <h3 class="card-title mb-2">{{ $personnel->prenom }} {{ $personnel->nom }}</h3>
                            <p class="text-muted mb-3">#{{ $personnel->id }} – {{ $personnel->poste }}</p>

                            <div class="row">
                                <div class="col-sm-6 mb-2"><strong>Sexe :</strong> {{ ucfirst($personnel->sexe) }}</div>
                                <div class="col-sm-6 mb-2"><strong>Email :</strong> {{ $personnel->email }}</div>
                                <div class="col-sm-6 mb-2"><strong>Téléphone :</strong> {{ $personnel->telephone }}</div>
                                <div class="col-sm-6 mb-2"><strong>Adresse :</strong> {{ $personnel->adresse }}</div>
                                <div class="col-sm-6 mb-2"><strong>Salaire :</strong> {{ number_format($personnel->salaire, 2) }} FCFA</div>
                                <div class="col-sm-6 mb-2"><strong>Date de naissance :</strong> {{ \Carbon\Carbon::parse($personnel->date_naissance)->format('d/m/Y') }}</div>
                                <div class="col-sm-6 mb-3"><strong>Date d'embauche :</strong> {{ \Carbon\Carbon::parse($personnel->date_emploi)->format('d/m/Y') }}</div>
                                <div class="col-sm-6 mb-3">
                                    <strong>État :</strong>
                                    @if($personnel->etat)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-danger">Inactif</span>
                                    @endif
                                </div>
                            </div>

                            <div class="text-end">
                                <a href="{{ route('personnels.crud') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-arrow-left"></i> Retour à la liste
                                </a>
                            </div>
                        </div>
                    </div> <!-- /.col-md-8 -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
