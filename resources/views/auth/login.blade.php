<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - Pharmacie</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-secondary">
  <div class="background">
    <div class="container mt-5 mb-5 ms-5 me-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow">
            <div class="card-header text-center bg-primary text-white">
              <h4>Créer un compte</h4>
            </div>
            <div class="card-body">
              <form action="{{ route('login.traitement') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                  <label for="email" class="form-label">Adresse email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="exemple@mail.com" required>
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">Mot de passe</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
                </div>

                <div class="d-grid">
                  <button type="submit" class="btn btn-primary">Se Connecter</button>
                </div>
              </form>

              @if(session('status'))
                <div class="alert alert-danger mt-3">
                  {{ session('status') }}
                </div>
              @endif
            </div>
            <div class="card-footer text-center">
              <small>Pas encore inscrit ? <a href="/register">S'inscrire</a></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
