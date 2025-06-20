@extends('layouts.admin-navbar')
@section('title', 'Modifier un client')

@section('content')
<h2>Modifier un client</h2>

{{-- IMPORTANT: ajout enctype pour upload fichier --}}
<form action="{{ route('clients.update', $client->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
    @csrf
    @method('PUT') {{-- Méthode HTTP PUT pour la mise à jour --}}

    <div class="row mb-3">
        <div class="col">
            <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
            <input type="text" name="nom" id="nom" class="form-control" 
                   value="{{ old('nom', $client->nom) }}" required>
            @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col">
            <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
            <input type="text" name="prenom" id="prenom" class="form-control" 
                   value="{{ old('prenom', $client->prenom) }}" required>
            @error('prenom') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" id="email" class="form-control" 
               value="{{ old('email', $client->user->email ?? '') }}" required>
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    {{-- Mot de passe --}}
    <div class="row mb-3">
    <div class="col position-relative">
        <label for="password" class="form-label">Nouveau mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">
        <small class="text-muted">Laisser vide si pas de changement</small>
        @error('password') <small class="text-danger">{{ $message }}</small> @enderror

        <button type="button" class="btn btn-sm btn-outline-secondary position-absolute" 
                style="top: 38px; right: 10px; z-index: 10;" 
                onclick="togglePasswordVisibility('password', this)">
            👁️
        </button>
    </div>

    <div class="col position-relative">
        <label for="password_confirmation" class="form-label">Confirmer mot de passe</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">

        <button type="button" class="btn btn-sm btn-outline-secondary position-absolute" 
                style="top: 38px; right: 10px; z-index: 10;" 
                onclick="togglePasswordVisibility('password_confirmation', this)">
            👁️
        </button>
    </div>
</div>

<script>
function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
        input.type = "text";
        btn.textContent = "🙈";
    } else {
        input.type = "password";
        btn.textContent = "👁️";
    }
}
</script>


    {{-- Avatar --}}
    <div class="mb-3">
        <label for="avatar" class="form-label">Avatar (image)</label>
        <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
        @error('avatar') <small class="text-danger">{{ $message }}</small> @enderror
        @if($client->user && $client->user->avatar)
            <div class="mt-2">
                <img src="{{ asset($client->user->avatar) }}" alt="Avatar actuel" style="max-height: 100px;">
            </div>
        @endif
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="sexe" class="form-label">Sexe</label>
            <select name="sexe" id="sexe" class="form-control">
                <option value="">-- Sélectionner --</option>
                <option value="homme" {{ old('sexe', $client->sexe) == 'homme' ? 'selected' : '' }}>Homme</option>
                <option value="femme" {{ old('sexe', $client->sexe) == 'femme' ? 'selected' : '' }}>Femme</option>
                <option value="personnalisee" {{ old('sexe', $client->sexe) == 'personnalisee' ? 'selected' : '' }}>Personnalisée</option>
            </select>
            @error('sexe') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="col">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control" 
                   value="{{ old('telephone', $client->telephone) }}">
            @error('telephone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse</label>
        <input type="text" name="adresse" id="adresse" class="form-control" 
               value="{{ old('adresse', $client->adresse) }}">
        @error('adresse') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-success">
        <i class="bi bi-check-circle"></i> Mettre à jour
    </button>
    <a href="{{ route('clients.crud') }}" class="btn btn-secondary">Annuler</a>
</form>

@if(session('status'))
    <div class="alert alert-success mt-3">
        {{ session('status') }}
    </div>
@endif
@endsection
