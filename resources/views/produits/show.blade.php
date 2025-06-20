@extends('layouts.admin-navbar')

@section('title', 'Détails du produit')

@section('content')
<div class="container mt-4">

    {{-- Message de succès --}}
    @if(session('succes'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('succes') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow mb-5">
                @if($produit->image)
                    <div class="text-center bg-light p-3">
                        <img src="{{ asset($produit->image) }}" 
                             class="img-fluid rounded" 
                             alt="Image du produit" 
                             style="max-height: 400px; object-fit: contain;">
                    </div>
                @endif

                <div class="card-body">
                    <h3 class="card-title text-center">{{ $produit->nom }}</h3>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <p><strong>Catégorie :</strong> {{ $produit->categorie }}</p>
                            <p><strong>Prix :</strong> {{ number_format($produit->prix, 2) }} FCFA</p>
                            <p><strong>Quantité en stock :</strong> {{ $produit->quantite }}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <p><strong>Date d’expiration :</strong> {{ $produit->date_expiration }}</p>
                            <p><strong>Description :</strong><br>{{ $produit->description }}</p>
                            <p><strong>État :</strong>
                                @if($produit->eta)
                                    <span class="badge bg-success">Disponible</span>
                                @else
                                    <span class="badge bg-danger">Indisponible</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('produits.crud') }}" class="btn btn-secondary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
