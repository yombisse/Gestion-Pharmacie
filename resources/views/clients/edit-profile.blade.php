<form method="POST" action="{{ route('client.updateProfile') }}">
    @csrf

    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" placeholder="Nom" required>
    <input type="text" name="firstname" value="{{ old('firstname', auth()->user()->firstname) }}" placeholder="Prénom" required>
    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Email" required>

    <input type="text" name="telephone" value="{{ old('telephone', auth()->user()->client->telephone) }}" placeholder="Téléphone" required>
    <input type="text" name="adresse" value="{{ old('adresse', auth()->user()->client->adresse) }}" placeholder="Adresse" required>

    <select name="sexe" required>
        <option value="homme" {{ auth()->user()->client->sexe == 'homme' ? 'selected' : '' }}>Homme</option>
        <option value="femme" {{ auth()->user()->client->sexe == 'femme' ? 'selected' : '' }}>Femme</option>
        <option value="personnalisee" {{ auth()->user()->client->sexe == 'personnalisee' ? 'selected' : '' }}>Personnalisée</option>
    </select>

    <button type="submit">Mettre à jour</button>
</form>
