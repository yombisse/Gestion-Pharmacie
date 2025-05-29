@extends('layout.app')
@section('title', 'Liste des clients')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Liste des clients</h2>
    <a href=" " class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Ajouter un client
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr>
                    <td>{{ $client->nom }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone }}</td>
                    <td>{{ $client->adresse }}</td>
                    <td class="text-center">
                        <a href=" " class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i> Modifier
                        </a>
                        <form action=" " method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun client trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
