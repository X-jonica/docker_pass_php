<?php
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Récupérer l'utilisateur depuis la base avec l'id stocké en session (pour éviter décalage données)
require_once '../models/User.php';
$user = User::getById($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Éditer le profil | SecurePass</title>
  <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap.min.css">
  <link href="../public/assets/fontawesome/css/all.min.css" rel="stylesheet">
  <link href="../public/assets/css/styleEdit_profile.css" rel="stylesheet">
</head>
<body>
  <div class="profile-container">
    <div class="profile-card d-flex justify-content-around">
      <!-- Section Profil -->
      <div class="form-section flex-grow-1">
          <div class="container mt-2">
            <?php if (isset($_SESSION['message'])): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= htmlspecialchars($_SESSION['message']); unset($_SESSION['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
              </div>
            <?php endif; ?>
          </div>
          <div class="profile-header">
            <i class="fas fa-user-cog text-primary mb-3" style="font-size: 2.5rem;"></i>
            <h3 class="font-weight-bold">Profil Utilisateur</h3>
            <p class="text-muted">Modifiez vos informations personnelles</p>
          </div>

          <form action="../controllers/UserController.php" method="POST">
            <input type="hidden" name="action" value="update_profile">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

            <div class="mb-4 position-relative">
              <label for="username" class="form-label fw-medium">Nom d'utilisateur</label>
              <div class="position-relative">
                <i class="fas fa-user input-icon"></i>
                <input type="text" name="username" class="form-control input-with-icon"
                       id="username" value="<?= htmlspecialchars($user['username']) ?>" required>
              </div>
            </div>

            <div class="mb-4 position-relative">
              <label for="email" class="form-label fw-medium">Adresse email</label>
              <div class="position-relative">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" name="email" class="form-control input-with-icon"
                       id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
              </div>
            </div>

            <div class="d-grid mt-4 pt-2">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i>Mettre à jour
              </button>
            </div>
          </form>

          <!-- Bouton Supprimer le compte -->
          <div class="mt-5 pt-3">
            <form action="../controllers/UserController.php" method="POST"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Toutes vos données seront définitivement perdues.');">
              <input type="hidden" name="action" value="delete_account">
              <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
              <button type="submit" class="btn btn-outline-danger w-100">
                <i class="fas fa-user-times mr-2"></i>Supprimer mon compte
              </button>
            </form>
            <div class="text-center mt-2">
              <a href="../views/dashboard.php" class="d-block mt-2 text-muted small">
                <i class="fas fa-arrow-left mr-1"></i> Retour au dashboard
              </a>
            </div>
          </div>
        </div>

        <!-- Section Mot de passe -->
        <div class="password-section flex-grow-1">
          <div class="container mt-2">
             <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i>
              <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
            <?php endif; ?>
          </div>
          <div class="profile-header">
            <i class="fas fa-lock text-primary mb-3" style="font-size: 2.5rem;"></i>
            <h3 class="font-weight-bold">Sécurité du compte</h3>
            <p class="text-muted">Changez votre mot de passe</p>
          </div>

          <form action="../controllers/UserController.php" method="POST" id="passwordForm">
            <input type="hidden" name="action" value="update_password">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

            <div class="mb-4 position-relative">
              <label for="current_password" class="form-label fw-medium">Mot de passe actuel</label>
              <div class="position-relative">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="current_password" class="form-control input-with-icon"
                       id="current_password" required>
                <i class="fas fa-eye password-toggle" id="toggleCurrentPassword"></i>
              </div>
            </div>

            <div class="mb-4 position-relative">
              <label for="new_password" class="form-label fw-medium">Nouveau mot de passe</label>
              <div class="position-relative">
                <i class="fas fa-key input-icon"></i>
                <input type="password" name="new_password" class="form-control input-with-icon"
                       id="new_password" required>
                <i class="fas fa-eye password-toggle" id="toggleNewPassword"></i>
              </div>
              <div class="password-strength">
                <div class="strength-bar" id="passwordStrength"></div>
              </div>
              <small class="text-muted">Minimum 8 caractères avec chiffres et lettres</small>
            </div>

            <div class="mb-4 position-relative">
              <label for="confirm_password" class="form-label fw-medium">Confirmer le mot de passe</label>
              <div class="position-relative">
                <i class="fas fa-check-circle input-icon"></i>
                <input type="password" name="confirm_password" class="form-control input-with-icon"
                       id="confirm_password" required>
                <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
              </div>
            </div>

            <div class="d-grid mt-4 pt-2">
              <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-key mr-2"></i>Changer le mot de passe
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="../public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    // Fonction pour basculer la visibilité des mots de passe
    function setupPasswordToggle(toggleId, inputId) {
      const toggle = document.getElementById(toggleId);
      const input = document.getElementById(inputId);

      toggle.addEventListener('click', function() {
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
      });
    }

    // Configurer les toggles pour chaque champ de mot de passe
    setupPasswordToggle('toggleCurrentPassword', 'current_password');
    setupPasswordToggle('toggleNewPassword', 'new_password');
    setupPasswordToggle('toggleConfirmPassword', 'confirm_password');

    // Indicateur de force du mot de passe
    document.getElementById('new_password').addEventListener('input', function(e) {
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

    // Validation du formulaire de mot de passe
    document.getElementById('passwordForm').addEventListener('submit', function(e) {
      const newPassword = document.getElementById('new_password').value;
      const confirmPassword = document.getElementById('confirm_password').value;

      if (newPassword !== confirmPassword) {
        alert('Les mots de passe ne correspondent pas');
        e.preventDefault();
        return false;
      }

      if (newPassword.length < 8) {
        alert('Le mot de passe doit contenir au moins 8 caractères');
        e.preventDefault();
        return false;
      }

      return true;
    });
  </script>
</body>
</html>