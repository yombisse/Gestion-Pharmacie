@extends('layout.app')

@section('title', 'Accueil')

@section('content')

    <header style="display: flex; align-items: center; gap: 10px; padding: 10px;">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Pharmacie" width="40">
        <h1>Pharmacie Dofiin Saamù 2025</h1>
    </header>

    <main style="padding: 20px;">
        <h2>Bienvenue sur la plateforme de pharmacie Dofiin Saamù !</h2>
    </main>
@endsection
