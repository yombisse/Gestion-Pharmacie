@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier mon profil</h2>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">Profil mis à jour avec succès !</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Nom -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input id="nom" type="text" name="nom" value="{{ old('name', $user->nom) }}" class="form-control" required>
            @error('nom') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Prénom -->
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input id="prenom" type="text" name="prenom" value="{{ old('firstname', $user->prenom) }}" class="form-control" required>
            @error('prenom') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Adresse -->
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input id="adresse" type="text" name="adresse" value="{{ old('adresse', $user->adresse) }}" class="form-control">
            @error('adresse') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Téléphone (client/personnel uniquement) -->
        @if($user->hasRole('client'))
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input id="telephone" type="text" name="telephone" value="{{ old('telephone', optional($user->client)->telephone) }}" class="form-control">
                @error('telephone') <div class="text-danger">{{ $status }}</div> @enderror
            </div>
        @elseif($user->hasRole('personnel'))
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone</label>
                <input id="telephone" type="text" name="telephone" value="{{ old('telephone', optional($user->personnel)->telephone) }}" class="form-control">
                @error('telephone') <div class="text-danger">{{ $status }}</div> @enderror
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
