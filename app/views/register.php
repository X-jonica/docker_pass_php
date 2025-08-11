<?php require_once '../config/config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription | SecurePass</title>
  <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap.min.css" />
  <link href="../public/assets/fontawesome/css/all.min.css" rel="stylesheet">
  <link href="../public/assets/css/styleRegister.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center min-vh-100" style="height: 100vh">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="register-card bg-white p-4 p-md-5">
          <div class="register-header text-center mb-4">
            <i class="fas fa-user-plus text-primary mb-3" style="font-size: 2.5rem;"></i>
            <h2 class="h3 font-weight-bold">Créer un compte</h2>
          </div>

          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i>
              <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <form method="POST" action="../controllers/UserController.php" class="mt-3" id="registerForm">
            <input type="hidden" name="action" value="register" />

            <div class="mb-4">
              <label for="username" class="form-label fw-medium">Nom d'utilisateur</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" id="username" name="username" placeholder="Votre pseudo" required />
              </div>
            </div>

            <div class="mb-4">
              <label for="email" class="form-label fw-medium">Adresse email</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control" id="email" name="email" placeholder="votre@email.com" required />
              </div>
            </div>

            <div class="mb-4">
              <label for="password" class="form-label fw-medium">Mot de passe</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required />
              </div>
              <div class="password-strength mt-2">
                <div class="strength-bar" id="passwordStrength"></div>
              </div>
              <small class="text-muted">8 caractères minimum avec chiffres et lettres</small>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">
              <i class="fas fa-user-plus me-2 mr-1"></i>S'inscrire
            </button>

            <div class="text-center mt-4 pt-3 border-top">
              <p class="mb-0">Déjà un compte ?
                <a href="../views/login.php" class="text-primary fw-medium">Se connecter</a>
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
  <script>
    // Indicateur de force du mot de passe
    document.getElementById('password').addEventListener('input', function(e) {
      const strengthBar = document.getElementById('passwordStrength');
      const strength = calculatePasswordStrength(e.target.value);

      strengthBar.style.width = strength.percentage + '%';
      strengthBar.style.backgroundColor = strength.color;
    });

    function calculatePasswordStrength(password) {
      let strength = 0;
      if (password.length > 7) strength += 30;
      if (password.match(/[a-z]/)) strength += 20;
      if (password.match(/[A-Z]/)) strength += 20;
      if (password.match(/[0-9]/)) strength += 20;
      if (password.match(/[^a-zA-Z0-9]/)) strength += 10;

      if (strength > 80) return { percentage: 100, color: '#28a745' };
      if (strength > 60) return { percentage: 75, color: '#17a2b8' };
      if (strength > 40) return { percentage: 50, color: '#ffc107' };
      return { percentage: Math.max(10, strength), color: '#dc3545' };
    }
  </script>
</body>
</html>