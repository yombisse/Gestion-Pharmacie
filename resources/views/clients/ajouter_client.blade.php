@extends('layouts.app')
@section('title', 'Ajouter un client')

@section('content')
<h2>Ajouter un client</h2>

{{-- IMPORTANT: ajout enctype pour upload fichier --}}
<form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data" class="mt-4" autocomplete="off">
    @csrf

    <div class="row mb-3">
        <div class="col">
            <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
            <input type="text" name="nom" id="nom" class="form-control" required>
            @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col">
            <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
            <input type="text" name="prenom" id="prenom" class="form-control" required>
            @error('prenom') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" id="email" class="form-control" required>
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    {{-- Mot de passe --}}
    <div class="row mb-3">
        <div class="col">
            <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
            <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col">
            <label for="password_confirmation" class="form-label">Confirmer mot de passe <span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
        </div>
    </div>

    {{-- Avatar --}}
    <div class="mb-3">
        <label for="avatar" class="form-label">Avatar (image)</label>
        <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
        @error('avatar') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="sexe" class="form-label">Sexe</label>
            <select name="sexe" id="sexe" class="form-control">
                <option value="">-- Sélectionner --</option>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="personnalisee">Personnalisée</option>
            </select>
            @error('sexe') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control">
            @error('telephone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse</label>
        <input type="text" name="adresse" id="adresse" class="form-control">
        @error('adresse') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Ajouter
    </button>
    <a href="{{ route('clients.crud') }}" class="btn btn-secondary">Annuler</a>
</form>

@if(session('status'))
    <div class="alert alert-success mt-3">
        {{ session('status') }}
    </div>
@endif
@endsection