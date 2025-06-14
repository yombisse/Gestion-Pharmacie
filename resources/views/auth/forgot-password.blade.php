@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="container mt-5" style="max-width: 500px">
    <h2 class="mb-4 text-center">Réinitialisation du mot de passe</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.check') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" name="email" id="email" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" name="firstname" id="firstname" class="form-control" required>
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary w-100">
                Vérifier les informations
            </button>
        </div>
    </form>
</div>
@endsection
