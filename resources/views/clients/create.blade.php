<!--@extends('layouts.app')

@section('title', isset($client) ? 'Modifier Client' : 'Ajouter Client')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">{{ isset($client) ? 'Modifier le Client' : 'Ajouter un Client' }}</h1>

    <form method="POST" action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store') }}">
        @csrf
        @if(isset($client)) @method('PUT') @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom *</label>
                <input type="text" class="form-control" id="nom" name="nom" 
                       value="{{ old('nom', $client->nom ?? '') }}" required>
            </div>
            
            <div class="col-md-6">
                <label for="prenom" class="form-label">Prénom *</label>
                <input type="text" class="form-control" id="prenom" name="prenom" 
                       value="{{ old('prenom', $client->prenom ?? '') }}" required>
            </div>
            
            <div class="col-md-6">
                <label for="sexe" class="form-label">Sexe *</label>
                <select class="form-select" id="sexe" name="sexe" required>
                    <option value="">Sélectionner...</option>
                    <option value="Masculin" {{ (old('sexe', $client->sexe ?? '') == 'Masculin') ? 'selected' : '' }}>Masculin</option>
                    <option value="Féminin" {{ (old('sexe', $client->sexe ?? '') == 'Féminin') ? 'selected' : '' }}>Féminin</option>
                </select>
            </div>
            
            <div class="col-md-6">
                <label for="telephone" class="form-label">Téléphone *</label>
                <input type="text" class="form-control" id="telephone" name="telephone" 
                       value="{{ old('telephone', $client->telephone ?? '') }}" required>
            </div>
            
            <div class="col-12">
                <label for="adresse" class="form-label">Adresse *</label>
                <textarea class="form-control" id="adresse" name="adresse" rows="3" required>{{ old('adresse', $client->adresse ?? '') }}</textarea>
            </div>
            
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> {{ isset($client) ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
                <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Annuler
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
-->