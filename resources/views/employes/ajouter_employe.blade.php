@extends('layouts.app')
@section('title', 'Ajouter un employé')

@section('content')
<h2>Ajouter un employé</h2>

<form action="{{ route('personnels.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        <div class="col">
            <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
            @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col">
            <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom') }}" required>
            @error('prenom') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col">
            <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
            <input type="text" name="password" id="password" class="form-control" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="poste" class="form-label">Poste <span class="text-danger">*</span></label>
            <input type="text" name="poste" id="poste" class="form-control" value="{{ old('poste') }}" required>
            @error('poste') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col">
            <label for="salaire" class="form-label">Salaire <span class="text-danger">*</span></label>
            <input type="number" name="salaire" id="salaire" class="form-control" value="{{ old('salaire') }}" step="0.01" required>
            @error('salaire') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') }}">
            @error('telephone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="form-control" value="{{ old('adresse') }}">
            @error('adresse') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col">
            <label for="photo" class="form-label">Photo de profil</label>
            <input type="file" name="photo" id="photo" accept="image/*" class="form-control">
            @error('photo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="sexe" class="form-label">Sexe</label>
            <select name="sexe" id="sexe" class="form-control">
                <option value="">-- Sélectionnez --</option>
                <option value="homme" {{ old('sexe') == 'homme' ? 'selected' : '' }}>Homme</option>
                <option value="femme" {{ old('sexe') == 'femme' ? 'selected' : '' }}>Femme</option>
                <option value="personnalisee" {{ old('sexe') == 'personnalisee' ? 'selected' : '' }}>Personnalisée</option>
            </select>
            @error('sexe') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
       <div class="col">
        <label for="date_naissance" class="form-label">Date de naissance <span class="text-danger">*</span></label>
        <input type="date" name="date_naissance" id="date_naissance" class="form-control" value="{{ old('date_naissance') }}" required>
        @error('date_naissance') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col">
        <label for="date_emploi" class="form-label">Date d'emploi <span class="text-danger">*</span></label>
        <input type="date" name="date_emploi" id="date_emploi" class="form-control" value="{{ old('date_emploi') }}" required>
        @error('date_emploi') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    </div>

   <div class="row mb-3">
    <div class="col">
        <label for="etat" class="form-label">État <span class="text-danger">*</span></label>
        <select name="etat" id="etat" class="form-control" required>
            <option value="">-- Sélectionner --</option>
            <option value="1" {{ old('etat') == '1' ? 'selected' : '' }}>Actif</option>
            <option value="0" {{ old('etat') == '0' ? 'selected' : '' }}>Inactif</option>
        </select>
        @error('etat') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    {{-- user_id caché si défini automatiquement --}}
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

    <button type="submit" class="btn btn-success">
        <i class="bi bi-check-circle"></i> Enregistrer
    </button>
    <a href="{{ route('personnels.crud') }}" class="btn btn-secondary">Annuler</a>
</form>

@if(session('status'))
    <div class="alert alert-success mt-3">
        {{ session('status') }}
    </div>
@endif
@endsection
