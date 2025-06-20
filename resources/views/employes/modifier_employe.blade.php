@extends('layouts.admin-navbar')

@section('content')
<div class="container">
    <h2>Modifier l'employé</h2>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('personnels.update', $personnel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Colonne de gauche -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom *</label>
                    <input type="text" class="form-control" id="nom" name="nom" 
                           value="{{ old('nom', $personnel->nom) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom *</label>
                    <input type="text" class="form-control" id="prenom" name="prenom"
                           value="{{ old('prenom', $personnel->prenom) }}" required>
                </div>

                <div class="mb-3">
                    <label for="sexe" class="form-label">Sexe *</label>
                    <select class="form-select" id="sexe" name="sexe" required>
                        <option value="homme" {{ old('sexe', $personnel->sexe) == 'homme' ? 'selected' : '' }}>Homme</option>
                        <option value="femme" {{ old('sexe', $personnel->sexe) == 'femme' ? 'selected' : '' }}>Femme</option>
                        <option value="personnalisee" {{ old('sexe', $personnel->sexe) == 'personnalisee' ? 'selected' : '' }}>Personnalisée</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date_naissance" class="form-label">Date de naissance *</label>
                    <input type="date" class="form-control" id="date_naissance" name="date_naissance"
                          value="{{ old('date_naissance', \Carbon\Carbon::parse($personnel->date_naissance)->format('Y-m-d')) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="date_emploi" class="form-label">Date d'embauche *</label>
                    <input type="date" class="form-control" id="date_emploi" name="date_emploi"
                           value="{{ old('date_emploi', \Carbon\Carbon::parse($personnel->date_emploi)->format('Y-m-d')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="poste" class="form-label">Poste *</label>
                    <input type="text" class="form-control" id="poste" name="poste"
                           value="{{ old('poste', $personnel->poste) }}" required>
                </div>
            </div>
            
            <!-- Colonne de droite -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="salaire" class="form-label">Salaire *</label>
                    <input type="number" step="0.01" class="form-control" id="salaire" name="salaire"
                           value="{{ old('salaire', $personnel->salaire) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ old('email', $personnel->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone *</label>
                    <input type="text" class="form-control" id="telephone" name="telephone"
                           value="{{ old('telephone', $personnel->telephone) }}" required>
                </div>

                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse *</label>
                    <textarea class="form-control" id="adresse" name="adresse" rows="3" required>{{ old('adresse', $personnel->adresse) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="etat" class="form-label">État *</label>
                    <select class="form-select" name="etat" id="etat" required>
                        <option value="1" {{ old('etat', $personnel->etat) == '1' ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ old('etat', $personnel->etat) == '0' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    @if($personnel->photo)
                        <div class="mt-2">
                            <img src="{{ asset($personnel->photo) }}" alt="Photo actuelle" class="img-thumbnail" width="100">
                            <p class="text-muted mt-1">Photo actuelle</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('personnels.crud') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
