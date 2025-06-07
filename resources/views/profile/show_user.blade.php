@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Mon Profil Client</h3>
        </div>
        
        <div class="card-body">
            @if(isset($message))
                <div class="alert alert-info">
                    {{ $message }}
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-6">
                    <h4>Informations de base</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Nom :</strong> {{ $user->name }}
                        </li>
                        <li class="list-group-item">
                            <strong>Email :</strong> {{ $user->email }}
                        </li>
                        <li class="list-group-item">
                            <strong>Inscrit depuis :</strong> {{ $user->created_at->format('d/m/Y') }}
                        </li>
                    </ul>
                </div>
                
                <div class="col-md-6">
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i> 
                        Votre profil client complet n'est pas encore configuré.
                        Contactez le support si vous pensez qu'il s'agit d'une erreur.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection