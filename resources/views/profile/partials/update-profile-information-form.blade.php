@extends('layouts.app')
@section('title', 'Liste des produits')
@section('content')
    <header>
        <h2 class="text-lg font-medium text-gray-900">Informations du profil</h2>
        <p class="mt-1 text-sm text-gray-600">
            Mettez à jour les informations de votre profil et votre adresse email.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Champs communs -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   required autofocus>
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   required>
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-800">
                        Votre email n'est pas vérifié.
                        <button form="send-verification" class="text-sm text-indigo-600 hover:text-indigo-900">
                            Cliquez ici pour renvoyer l'email de vérification.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600">
                            Un nouveau lien de vérification a été envoyé à votre adresse email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Champs spécifiques CLIENT -->
        @if($user->hasRole('client'))
            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" id="telephone" name="telephone" 
                       value="{{ old('telephone', $user->client->telephone ?? '') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       required>
                @error('telephone')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                <textarea id="adresse" name="adresse" rows="3"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                          required>{{ old('adresse', $user->client->adresse ?? '') }}</textarea>
                @error('adresse')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <!-- Champs spécifiques PERSONNEL -->
        @if($user->hasRole('personnel'))
            <div>
                <label for="poste" class="block text-sm font-medium text-gray-700">Poste</label>
                <input type="text" id="poste" name="poste" 
                       value="{{ old('poste', $user->personnel->poste ?? '') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       required>
                @error('poste')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="departement" class="block text-sm font-medium text-gray-700">Département</label>
                <select id="departement" name="departement"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                    <option value="">Sélectionnez...</option>
                    <option value="ventes" {{ (old('departement', $user->personnel->departement ?? '') == 'ventes') ? 'selected' : '' }}>Ventes</option>
                    <option value="support" {{ (old('departement', $user->personnel->departement ?? '') == 'support') ? 'selected' : '' }}>Support</option>
                    <option value="logistique" {{ (old('departement', $user->personnel->departement ?? '') == 'logistique') ? 'selected' : '' }}>Logistique</option>
                </select>
                @error('departement')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <div class="flex items-center gap-4">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Enregistrer
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                    Sauvegardé.
                </p>
            @endif
        </div>
    </form>
@ensection