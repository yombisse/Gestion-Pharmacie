@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

<!-- Header -->
<header style="display: flex; flex-direction: column; align-items: center; padding: 10px;">
    <img src="{{ asset('images/logo.png') }}" alt="Logo Pharmacie" width="35">
    <h2>Pharmacie Dofiin Saamù 2025</h2>
</header>

<style>
    body, html {
        margin: 0;
        padding: 0;
    }

    .welcome-container {
        width: 100%;
        max-width: 900px;
        margin: 20px auto;
        text-align: center;
    }

    .welcome-image {
        width: 80%;
        height: 70vh; /* la hauteur est automatique selon l’image */
        border-radius: 5px;
        margin-bottom: 15px;
    }
    .login-btn {
        background-color: #0d6efd;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .login-btn:hover {
        background-color: #0b5ed7;
    }
</style>

<div class="welcome-container">
    <img src="{{ asset('images/pharmacie.jpg') }}" alt="Bienvenue à la pharmacie" class="welcome-image">
    <h2>Bienvenue à la Pharmacie Dofiin Saamù</h2>
    <p>Votre santé est notre priorité. Accédez à nos services en vous connectant.</p>
    
    @auth
        <a href="{{ route('dashboard') }}" class="login-btn">Accéder au tableau de bord</a>
    @else
        <a style="text-decoration: none;" href="{{ route('login') }}" class="login-btn">Entrer</a>
    @endauth
</div>

<main style="padding: 20px; text-align: center;">
    <h2>Nos services</h2>
    <p>Commandez vos médicaments en toute sécurité, gérez vos ordonnances et accédez à vos informations de santé.</p>
</main>

@endsection
