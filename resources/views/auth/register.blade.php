<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset("images/fond.jpg") }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px;
        }
        
        .register-container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .register-card {
            border: none;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            max-height: calc(100vh - 40px); /* Empêche le dépassement */
           
        }
        
        .card-header {
            background-color: #0d6efd;
            color: white;
            padding: 1rem;
            text-align: center;
            font-size: 1.25rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .form-control, .form-select {
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            height: auto;
        }
        
        .section-title {
            color: #0d6efd;
            font-size: 1rem;
            font-weight: 600;
            margin: 1rem 0 0.75rem;
        }

        @media (max-width: 768px) {
            .register-container {
                max-width: 95%;
            }
            .card-body {
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="register-card">
            <div class="card-header">
                Créer un compte
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('store') }}">
                    @csrf

                    <h6 class="section-title">INFORMATIONS DE CONNEXION</h6>

                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" id="name" name="name" class="form-control" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="text" id="firstname" name="firstname" class="form-control" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="tel" id="telephone" name="telephone" class="form-control" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirmation</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <h6 class="section-title">INFORMATIONS PERSONNELLES</h6>

                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label for="sexe" class="form-label">Sexe</label>
                            <select id="sexe" name="sexe" class="form-select" required>
                                <option value="" disabled selected>-- Sélectionnez --</option>
                                <option value="homme">Homme</option>
                                <option value="femme">Femme</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="date_naissance" class="form-label">Date de naissance</label>
                            <input type="date" id="date_naissance" name="date_naissance" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" id="adresse" name="adresse" class="form-control" required>
                    </div>

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 pt-2 border-top">
                        <a href="{{ route('login') }}" class="text-decoration-none mb-2 mb-md-0 small">Déjà un compte ? Se connecter</a>
                        <button type="submit" class="btn btn-primary btn-sm px-3">
                            S'inscrire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>