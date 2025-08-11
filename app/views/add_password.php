<?php
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un mot de passe | SecurePass</title>
    <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap.min.css">
    <link href="../public/assets/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="../public/assets/css/styleAdd_password.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="password-form-container">
            <div class="form-header">
                <h2 class="d-flex align-items-center">
                    <i class="fas fa-key text-primary mr-3"></i>
                    Ajouter un mot de passe
                </h2>
                <p class="text-muted">Renseignez les informations d'accès à enregistrer</p>
            </div>

            <?php if (!empty($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?= htmlspecialchars($_SESSION['success_message']) ?>
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error_message'])): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= htmlspecialchars($_SESSION['error_message']) ?>
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

            <form action="../controllers/PasswordController.php" method="POST" class="row g-3">
                <input type="hidden" name="action" value="add">

                <div class="col-md-6">
                    <label for="site_name" class="form-label required-field">Nom du site</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                        <input type="text" class="form-control" id="site_name" name="site_name" placeholder="Ex: Google" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="site_url" class="form-label">URL du site</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                        <input type="url" class="form-control" id="site_url" name="site_url" placeholder="https://">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="login" class="form-label required-field">Identifiant</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Email ou nom d'utilisateur" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label required-field">Mot de passe</label>
                    <div class="position-relative">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                    </div>
                    <small class="text-muted">8 caractères minimum avec chiffres et lettres</small>
                </div>

                <div class="col-12">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Informations supplémentaires (optionnel)"></textarea>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary mr-3">
                        <i class="fas fa-save mr-2"></i>Enregistrer
                    </button>
                    <a href="dashboard.php" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Retour
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="../public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fonction pour basculer la visibilité du mot de passe
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });

        // Validation basique du formulaire
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            if (password.length < 8) {
                alert('Le mot de passe doit contenir au moins 8 caractères');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>