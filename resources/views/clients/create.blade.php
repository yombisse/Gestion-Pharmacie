@extends('layout.app')
@section('title', 'Ajouter un client')

@section('content')
<h2>Ajouter un client</h2>

<form action="{{route('ajouter_employe')}} " method="POST" class="mt-4" enctype="multipart/form-data">
    
    @csrf
    <div class="row mb-3">
            <div class="col">
            <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        <div class="col">
            <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
            <input type="text" name="prenom" id="prenom" class="form-control" required>
        </div>
                <div class="col">
            <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
            <input type="text" name="password" id="password" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="poste" class="form-label">Poste <span class="text-danger">*</span></label>
            <input type="text" name="poste" id="poste" class="form-control" required>
        </div>
        <div class="col">
            <label for="salaire" class="form-label">Salaire <span class="text-danger">*</span></label>
            <input type="text" name="salaire" id="salaire" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="col">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="form-control">
        </div>
        <div class="col">
            <label for="photo" class="form-label">Photo de profile</label>
            <input type="file" name="photo" id="photo" accept="image/*" class="form-control" required>
        </div>
    </div>
    <button type="submit" class="btn btn-success">
        <i class="bi bi-check-circle"></i> Enregistrer
    </button>
    <a href=" " class="btn btn-secondary">Annuler</a>
</form>
@if(session('status'))
                <div class="alert alert-danger mt-3">
                  {{ session('status') }}
                </div>
              @endif
@endsection
