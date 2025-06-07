@extends('layouts.app')
@section('title', 'Liste des employés')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Liste des employés</h4>
            <a href="{{ route('personnels.create') }}" class="btn btn-light btn-sm">+ Ajouter un employé</a>
        </div>

        <div class="card-body">
            <!-- Message de succès -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Tableau des employés -->
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-secondary text-center">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Poste</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($personnels as $personnel)
                        <tr>
                            <td>{{ $personnel->nom }}</td>
                            <td>{{ $personnel->prenom }}</td>
                            <td>{{ $personnel->email }}</td>
                            <td>{{ $personnel->poste }}</td>
                            <td class="text-center">
                                <a href="{{ route('personnels.show', $personnel->id) }}" class="btn btn-info btn-sm">Voir</a>
                                <a href="{{ route('personnels.edit', $personnel->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                                <form action="{{ route('personnels.destroy', $personnel->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer cet employé ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucun employé trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $personnels->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
