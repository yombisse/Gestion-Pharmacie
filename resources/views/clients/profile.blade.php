@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0"><i class="fas fa-user-edit me-2"></i>Modifier mon profil</h2>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('clients.profile.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="nom" value="{{ old('nom', $client->nom) }}" 
                                           class="form-control @error('nom') is-invalid @enderror">
                                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Prénom</label>
                                    <input type="text" name="prenom" value="{{ old('prenom', $client->prenom) }}" 
                                           class="form-control @error('prenom') is-invalid @enderror">
                                    @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="telephone" value="{{ old('telephone', $client->telephone) }}" 
                                   class="form-control @error('telephone') is-invalid @enderror">
                            @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Adresse</label>
                            <input type="text" name="adresse" value="{{ old('adresse', $client->adresse) }}" 
                                   class="form-control @error('adresse') is-invalid @enderror">
                            @error('adresse') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                            @if ($client->user->avatar)
                                <div class="mt-2">
                                    <img src="{{ asset($client->user->avatar) }}" alt="Photo actuelle" class="img-thumbnail" style="width: 100px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_photo" id="remove_photo">
                                        <label class="form-check-label" for="remove_photo">Supprimer la photo actuelle</label>
                                    </div>
                                </div>
                            @endif
                            @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3"><i class="fas fa-lock me-2"></i>Changer le mot de passe</h5>

                        <div class="form-group mb-3 position-relative">
                            <label class="form-label">Ancien mot de passe</label>
                            <input type="password" name="current_password" 
                                   class="form-control @error('current_password') is-invalid @enderror">
                            <button type="button" class="btn btn-sm btn-outline-secondary position-absolute toggle-password" 
                                    style="top: 32px; right: 10px;">
                                <i class="fas fa-eye"></i>
                            </button>
                            @error('current_password') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="form-group mb-3 position-relative">
                            <label class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror">
                            <button type="button" class="btn btn-sm btn-outline-secondary position-absolute toggle-password" 
                                    style="top: 32px; right: 10px;">
                                <i class="fas fa-eye"></i>
                            </button>
                            @error('password') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="form-group mb-4 position-relative">
                            <label class="form-label">Confirmer le nouveau mot de passe</label>
                            <input type="password" name="password_confirmation" 
                                   class="form-control @error('password_confirmation') is-invalid @enderror">
                            <button type="button" class="btn btn-sm btn-outline-secondary position-absolute toggle-password" 
                                    style="top: 32px; right: 10px;">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
        const input = this.parentElement.querySelector('input');
        const icon = this.querySelector('i');
        
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
});
</script>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    
    .border-primary {
        border-width: 2px !important;
    }
    
    .form-label {
        font-weight: 500;
    }
    
    .toggle-password {
        cursor: pointer;
    }
</style>
@endsection
