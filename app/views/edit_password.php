<?php
require_once '../config/config.php';
require_once __DIR__ . '/../models/Password.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../views/login.php');
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_message'] = "Aucun mot de passe sélectionné pour modification";
    header("Location: dashboard.php");
    exit;
}

$id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];
$entry = Password::getById($id, $user_id);

if (!$entry) {
    $_SESSION['error_message'] = "Ce mot de passe n'existe pas ou vous n'y avez pas accès";
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier mot de passe | SecurePass</title>
    <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap.min.css">
    <link href="../public/assets/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="../public/assets/css/styleEdit_password.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="password-form-container">
            <div class="form-header">
                <h2 class="d-flex align-items-center">
                    <i class="fas fa-key text-warning mr-3"></i>
                    Modifier un mot de passe
                </h2>
                <p class="text-muted">Mettez à jour les informations d'accès</p>
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
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?= htmlspecialchars($entry['id']) ?>">

                <div class="col-md-6">
                    <label for="site_name" class="form-label required-field">Nom du site</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-globe"></i></span>
                        <input type="text" class="form-control" id="site_name" name="site_name"
                               value="<?= htmlspecialchars($entry['site_name']) ?>" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="site_url" class="form-label">URL du site</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                        <input type="url" class="form-control" id="site_url" name="site_url"
                               value="<?= htmlspecialchars($entry['site_url']) ?>" placeholder="https://">
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="login" class="form-label required-field">Identifiant</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="login" name="login"
                               value="<?= htmlspecialchars($entry['login']) ?>" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="password-input-group">
                        <input type="password" class="form-control" id="password"
                               value="••••••••"
                               data-real-password="<?= htmlspecialchars($entry['password_decrypted'], ENT_QUOTES) ?>"
                               readonly>
                        <div class="password-actions">
                            <button type="button" id="showPassword" class="btn btn-sm btn-outline-secondary password-action-btn">
                                <i class="fas fa-eye mr-1"></i>Afficher
                            </button>
                            <button type="button" id="copyPassword" class="btn btn-sm btn-outline-primary password-action-btn">
                                <i class="fas fa-copy mr-1"></i>Copier
                            </button>
                        </div>
                        <input type="hidden" name="password" id="realPassword" value="<?= htmlspecialchars($entry['password_decrypted'], ENT_QUOTES) ?>">
                    </div>
                    <small class="text-muted">Laissez vide pour conserver le mot de passe actuel</small>
                </div>

                <div class="col-12">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3"><?= htmlspecialchars($entry['notes']) ?></textarea>
                </div>

                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-warning mr-3">
                        <i class="fas fa-save mr-2"></i>Mettre à jour
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
    document.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.getElementById('password');
        const showBtn = document.getElementById('showPassword');
        const copyBtn = document.getElementById('copyPassword');
        const realPasswordField = document.getElementById('realPassword');
        let isVisible = false;

        showBtn.addEventListener('click', function() {
            if (isVisible) {
                passwordField.type = 'password';
                passwordField.value = '••••••••';
                showBtn.innerHTML = '<i class="fas fa-eye mr-1"></i>Afficher';
                isVisible = false;
            } else {
                passwordField.type = 'text';
                passwordField.value = passwordField.dataset.realPassword;
                showBtn.innerHTML = '<i class="fas fa-eye-slash mr-1"></i>Masquer';
                isVisible = true;
            }
        });

        copyBtn.addEventListener('click', function() {
            navigator.clipboard.writeText(passwordField.dataset.realPassword)
                .then(() => {
                    const originalHtml = copyBtn.innerHTML;
                    copyBtn.innerHTML = '<i class="fas fa-check mr-1"></i>Copié!';
                    setTimeout(() => copyBtn.innerHTML = originalHtml, 2000);
                })
                .catch(err => {
                    console.error('Erreur de copie: ', err);
                });
        });

        // Empêcher le copier-coller manuel
        passwordField.addEventListener('copy paste cut', function(e) {
            e.preventDefault();
            return false;
        });

        // Mettre à jour le champ caché si l'utilisateur modifie le mot de passe
        passwordField.addEventListener('input', function() {
            realPasswordField.value = passwordField.value;
        });
    });
    </script>
</body>
</html>