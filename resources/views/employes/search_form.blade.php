<!--@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier un employé</h2>
    
    <form action="{{ route('employes.find.email') }}" method="POST" class="mt-4">
        @csrf
        
        <div class="mb-3">
            <label for="email" class="form-label">Email de l'employé</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <small class="text-muted">Entrez l'email unique de l'employé à modifier</small>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-search"></i> Rechercher
        </button>
    </form>
</div>
@endsection-->