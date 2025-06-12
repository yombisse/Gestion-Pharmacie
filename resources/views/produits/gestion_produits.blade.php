@extends('layouts.app')
@section('title', 'Liste des produits')
@section('content')

<div class="container py-4">
    <!-- En-tête avec bouton -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
        <h1 class="mb-3 mb-md-0 text-center text-md-start">
            <i class="bi bi-box-seam"></i> Catalogue des Produits
        </h1>
        <a href="{{ route('produits.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Ajouter un produit
        </a>
    </div>

    <!-- Barre de recherche améliorée -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form class="row g-2" method="GET" action="{{ route('produits.crud') }}">
                <div class="col-md-9">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="bi bi-search"></i>
                        </span>
                        <input class="form-control form-control-lg" type="search" name="recherche" 
                               value="{{ request('recherche') }}" 
                               placeholder="Rechercher un produit..." aria-label="Recherche">
                    </div>
                </div>
                <div class="col-md-3 d-grid">
                    <button class="btn btn-primary btn-lg" type="submit">
                        <i class="bi bi-funnel"></i> Filtrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if($produits->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($produits as $produit)
                @if($produit->eta)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Badge de statut -->
                        <div class="position-absolute end-0 top-0 m-2">
                            <span class="badge bg-{{ $produit->quantite > 0 ? 'success' : 'danger' }}">
                                {{ $produit->quantite > 0 ? 'Disponible' : 'Rupture' }}
                            </span>
                        </div>
                        
                        <!-- Image du produit -->
                        <div class="product-image-container">
                            @if($produit->image)
                            <img src="{{ asset($produit->image) }}" class="card-img-top" alt="{{ $produit->nom }}" style="height: 200px; object-fit: cover;">
                            @else
                            <img src="{{ asset('images/default.png') }}" class="card-img-top" alt="Image par défaut" style="height: 200px; object-fit: cover;">
                            @endif
                        </div>

                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $produit->nom }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($produit->description, 80) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-info text-dark">{{ $produit->categorie }}</span>
                                <h5 class="mb-0 text-primary">{{ number_format($produit->prix, 2) }} FCFA</h5>
                            </div>
                            
                            <div class="progress mb-3" style="height: 8px;">
                                <div class="progress-bar bg-{{ $produit->quantite > 10 ? 'success' : ($produit->quantite > 0 ? 'warning' : 'danger') }}" 
                                     role="progressbar" 
                                     style="width: {{ min(100, ($produit->quantite / 50) * 100) }}%" 
                                     aria-valuenow="{{ $produit->quantite }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="50">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-0">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye"></i> Voir
                                </a>
                                <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <!-- Pagination stylisée -->
        <div class="d-flex justify-content-center mt-5">
            <nav aria-label="Page navigation">
                {{ $produits->onEachSide(1)->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    @else
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="bi bi-box-seam display-1 text-muted"></i>
                <h3 class="mt-3">Aucun produit disponible</h3>
                <p class="text-muted">Commencez par ajouter votre premier produit</p>
                <a href="{{ route('produits.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle"></i> Ajouter un produit
                </a>
            </div>
        </div>
    @endif
</div>

<style>
    .product-image-container {
        height: 200px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .empty-state {
        max-width: 500px;
        margin: 0 auto;
    }
</style>

@endsection