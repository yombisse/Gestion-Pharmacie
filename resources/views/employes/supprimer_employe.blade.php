@extends('layouts.app')

@section('content')

<form action="{{ route('employes.destroyByEmail') }}" method="POST">
    @csrf
    

    <label for="email">Email de l'employé :</label>
    <input type="email" name="email" required>

    <button type="submit">Supprimer</button>
</form>

@if(session('success'))
    <div style="color: green">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div style="color: red">{{ session('error') }}</div>
@endif
@endsection
