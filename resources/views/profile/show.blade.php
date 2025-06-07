@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="card">
    <div class="card-header bg-success text-white">Mon Profil</div>
    <div class="card-body">
        <p><strong>Nom :</strong> {{ $user->name }}</p>
        <p><strong>Email :</strong> {{ $user->email }}</p>
        <p><strong>Rôle :</strong> {{ ucfirst($user->roles->pluck('name')->first()) }}</p>
        <!-- Ajoutez d'autres informations spécifiques -->
    </div>
</div>
@endsection
