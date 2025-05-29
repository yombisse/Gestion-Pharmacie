<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacie-droit d'utilisateur</title>
</head>
<body>
    <style>
        .formulaire{
            border: solid;
            border-width: 3;
            border-color: blue;
            width: 600px;
            height: auto;
            background-color: aliceblue;
        }
    </style>
    

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif
    <div class="formulaire">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nom" required>
            <input type="email" name="email" placeholder="Email" required>
            
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
            
            <select name="role" required>
                <option value="">--Choisir un rôle--</option>
                <option value="admin">Admin</option>
                <option value="employee">Employé</option>
            </select>

            <button type="submit">Créer utilisateur</button>
        </form>
    </div>
    </body>
</html>
