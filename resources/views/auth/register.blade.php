<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription - Pharmacie</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body class="bg-light">
  <div class="background">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow">
            <div class="card-header text-center bg-primary text-white">
              <h4>Créer un compte</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('register.traitement') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="nom" class="form-label">Nom </label>
                  <input type="text" class="form-control" id="nom" name="name" placeholder="Votre Nom" required>
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Prenom </label>
                  <input type="text" class="form-control" id="prenom" name="firstname" placeholder="Votre Prenom" required>
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Adresse email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="exemple@mail.com" required>
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">Mot de passe</label>
                  <input type="password" class="form-control" id="mot_de_passe" name="password" placeholder="********" required>
                </div>

                <div class="mb-3">
                  <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="d-grid">
                  <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
              </form>
               @if(session('status'))
                <div class="alert alert-danger mt-3">
                  {{ session('status') }}
                </div>
              @endif
       
            </div>
            <div class="card-footer text-center">
              <small>Déjà inscrit ? <a href="/login">Se connecter</a></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
