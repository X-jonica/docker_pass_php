<?php require_once '../config/config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion | SecurePass</title>
  <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap.min.css" />
  <link href="../public/assets/fontawesome/css/all.min.css" rel="stylesheet">
  <link href="../public/assets/css/styleLogin.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center min-vh-100" style="height: 100vh">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="login-card bg-white p-4 p-md-5">
          <div class="login-header text-center mb-4">
            <i class="fas fa-lock text-primary mb-3" style="font-size: 2.5rem;"></i>
            <h2 class="h3 font-weight-bold">Connexion</h2>
          </div>

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i>
              <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle me-2"></i>
              <?= htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <form method="POST" action="../controllers/UserController.php" class="mt-3">
            <input type="hidden" name="action" value="login" />

            <div class="mb-4">
              <label for="email" class="form-label fw-medium">Adresse email</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" id="email" name="email" class="form-control" placeholder="votre@email.com" required autofocus />
              </div>
            </div>

            <div class="mb-4">
              <label for="password" class="form-label fw-medium">Mot de passe</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required />
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">
              <i class="fas fa-sign-in-alt me-2 mr-1"></i>Se connecter
            </button>

            <div class="text-center mt-4 pt-3 border-top">
              <p class="mb-0">Pas encore de compte ?
                <a href="../views/register.php" class="text-primary fw-medium">Créer un compte</a>
              </p>
              <a href="../index.php" class="d-block mt-2 text-muted small">
                <i class="fas fa-arrow-left me-1"></i> Retour à l'accueil
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="../public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>