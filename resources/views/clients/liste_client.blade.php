@extends('layouts.admin-navbar')
@section('title', 'Liste des clients')
@section('content')

<div class="container mt-4">
    <h1 class="mb-3 text-center">Liste des Clients</h1>

    <!-- Bouton ajouter client -->
    <div class="mb-3 text-end">
        <a href="{{ route('clients.create') }}" class="btn btn-success">+ Ajouter un client</a>
    </div>

    <!-- Formulaire de recherche -->
    <form class="d-flex mb-4" method="GET" action="#">
        <input class="form-control me-2" type="search" name="recherche" value="{{ request('recherche') }}" placeholder="Rechercher un client..." aria-label="Recherche">
        <button class="btn btn-outline-success" type="submit">Rechercher</button>
    </form>

    @if($clients->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Sexe</th>
                        <th>Adresse</th>
                        <th>Téléphone</th>
                        <th class="text-center" style="width: 180px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->nom }}</td>
                            <td>{{ $client->prenom }}</td>
                            <td>{{ ucfirst($client->sexe) }}</td>
                            <td>{{ $client->adresse }}</td>
                            <td>{{ $client->telephone }}</td>
                            <td class="text-center">
                                <a href="{{ route('clients.show', $client->id) }}" class="btn btn-primary btn-sm">Détails</a>
                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $clients->links() }}
        </div>
    @else
        <p class="text-center">Aucun client trouvé.</p>
    @endif
</div>

@endsection
