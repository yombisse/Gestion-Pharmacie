@extends('layout.app')
@section('title', 'Modifier le client')

@section('content')
<h2>Modifier le client</h2>

<form action=" " method="POST" class="mt-4">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
        <input type="text" name="nom" id="nom" class="form-control" value=" " required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value=" ">
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone</label>
        <input type="text" name="telephone" id="telephone" class="form-control" value=" ">
    </div>
    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse</label>
        <input type="text" name="adresse" id="adresse" class="form-control" value=" ">
    </div>
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-pencil-square"></i> Mettre à jour
    </button>
    <a href=" " class="btn btn-secondary">Annuler</a>
</form>
@endsection
