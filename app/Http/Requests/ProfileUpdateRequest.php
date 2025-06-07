<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{

public function rules()
{
    $user = $this->user();

    if ($user->hasRole('admin')) {
        // Admin peut modifier tout sauf l'id (jamais modifiable)
        return [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'adresse' => ['sometimes', 'string', 'max:255'],
            // autres champs communs s’il y en a
        ];
    } elseif ($user->hasRole('client')) {
        // Client ne modifie pas id, poste, salaire, eta
        return [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'adresse' => ['sometimes', 'string', 'max:255'],
            'telephone' => ['sometimes', 'string', 'max:20'],
            // autres champs clients modifiables
        ];
    } elseif ($user->hasRole('personnel')) {
        // Personnel ne modifie pas poste, salaire, eta
        return [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'adresse' => ['sometimes', 'string', 'max:255'],
            'telephone' => ['sometimes', 'string', 'max:20'],
            // autres champs personnels modifiables
        ];
    }

    // Par défaut, règles minimales
    return [
        'nom' => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
    ];
}

}
