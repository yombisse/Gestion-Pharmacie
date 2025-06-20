@extends('layouts.admin-navbar')

@section('title', 'Détails du client')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Détails du client</h4>
                </div>

                <div class="card-body text-center">
                    {{-- Avatar --}}
                    @if($client->user && $client->user->avatar)
                        <img src="{{ asset($client->user->avatar) }}" alt="Avatar" class="rounded-circle mb-3" width="120" height="120">
                    @else
                        <img src="{{ asset('uploads/images/avatar.jpg') }}" alt="Avatar par défaut" class="rounded-circle mb-3" width="120" height="120">
                    @endif

                    <ul class="list-group list-group-flush text-start">
                        <li class="list-group-item"><strong>ID :</strong> {{ $client->id }}</li>
                        <li class="list-group-item"><strong>Nom :</strong> {{ $client->nom }}</li>
                        <li class="list-group-item"><strong>Prénom :</strong> {{ $client->prenom }}</li>
                        <li class="list-group-item"><strong>Sexe :</strong> {{ ucfirst($client->sexe) }}</li>
                        <li class="list-group-item"><strong>Téléphone :</strong> {{ $client->telephone }}</li>
                        <li class="list-group-item"><strong>Adresse :</strong> {{ $client->adresse }}</li>
                    </ul>

                    <div class="mt-4">
                        <a href="{{ route('clients.crud') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
