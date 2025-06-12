@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

<!-- Header -->
<header style="display: flex; align-items: center; gap: 10px; padding: 10px;">
    <img src="{{ asset('images/logo.png') }}" alt="Logo Pharmacie" width="40">
    <h1>Pharmacie Dofiin Saamù 2025</h1>
    
</header>
<style>
   body, html {
    height: 90%;
    margin: 0;
}

.container-center {
    display: block;
    justify-content: center;
    align-items: center;
    height: 50vh; 
    background-color: #f8f9fa; 
}

.card {
    border: 2px solid #ccc;
    margin: 40px auto; /* centre horizontalement */
    border-radius: 10px;
    padding: 20px;
    width: 90%;
    max-width: 700px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* optionnel : un bel effet */
}


/* Responsive */
@media (max-width: 768px) {
    .card {
        width: 90%;
    }
}



/* Responsive */
@media (max-width: 768px) {
    .card {
        width: 90%;
    }
}

</style>
<!-- Carousel -->
 <div class="card">
        <div id="carouselAccueil" class="carousel slide mx-3 mb-4 " data-bs-ride="carousel">
            <div class="carousel-inner rounded shadow">
                <div class="carousel-item active">
                    <img src="{{ asset('images/carousel1.jpg') }}" class="d-block w-100" alt="Image 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/fond.jpg') }}" class="d-block w-100" alt="Image 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/carousel3.jpg') }}" class="d-block w-100" alt="Image 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselAccueil" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselAccueil" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
</div>

<!-- Main content -->
<main style="padding: 20px;">
    <h2>Bienvenue sur la plateforme de pharmacie Dofiin Saamù !</h2>
    <p>Commandez vos médicaments en toute sécurité, gérez vos ordonnances et accédez à vos informations de santé.</p>
</main>

@endsection
