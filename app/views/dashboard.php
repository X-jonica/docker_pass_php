<?php
require_once '../config/config.php';
require_once __DIR__ . '/../models/Password.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$passwords = Password::getAllByUser($user_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord | SecurePass</title>
    <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap.min.css">
    <link href="../public/assets/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="../public/assets/css/styleDashboard.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-header py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 d-flex align-items-center">
                    <i class="fas fa-lock text-primary mr-2"></i>
                    <span id="dashboard-title">Mon tableau de bord</span>
                </h2>
                <div class="d-flex">
                    <button id="deconnexion" class="btn btn-outline-secondary mr-2">
                        <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
                    </button>
                    <a href="/views/edit_profile.php" class="btn btn-outline-success mr-2">
                        <i class="fas fa-user mr-1"></i> Profile
                    </a>
                    <a href="/views/add_password.php" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Ajouter
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
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

        <?php if ($passwords && count($passwords) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-globe mr-1"></i> Site</th>
                            <th><i class="fas fa-link mr-1"></i> URL</th>
                            <th><i class="fas fa-user mr-1"></i> Identifiant</th>
                            <th><i class="fas fa-calendar-alt mr-1"></i> Date d'ajout</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($passwords as $entry): ?>
                            <tr>
                                <td><?= htmlspecialchars($entry['site_name']) ?></td>
                                <td>
                                    <a href="<?= htmlspecialchars($entry['site_url']) ?>" target="_blank" class="text-primary">
                                        <?= htmlspecialchars(parse_url($entry['site_url'], PHP_URL_HOST)) ?>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($entry['login']) ?></td>
                                <td><?= date('d/m/Y', strtotime($entry['created_at'])) ?></td>
                                <td class="d-flex">
                                    <a href="edit_password.php?id=<?= htmlspecialchars($entry['id']) ?>"
                                       class="btn btn-outline-primary action-btn mr-2"
                                       title="Modifier">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="../controllers/PasswordController.php" method="POST">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($entry['id']) ?>">
                                        <button type="submit"
                                                class="btn btn-outline-danger action-btn"
                                                title="Supprimer"
                                                onclick="return confirm('Voulez-vous vraiment supprimer ce mot de passe ?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-key text-muted mb-3" style="font-size: 3rem;"></i>
                <h4 class="text-muted">Aucun mot de passe enregistré</h4>
                <p class="text-muted">Commencez par ajouter votre premier mot de passe</p>
                <a href="/views/add_password.php" class="btn btn-primary mt-3">
                    <i class="fas fa-plus mr-1"></i> Ajouter un mot de passe
                </a>
            </div>
        <?php endif; ?>
    </div>

    <script src="../public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("deconnexion").addEventListener("click", () => {
            if(confirm("Voulez-vous vraiment vous déconnecter ?")) {
                window.location.href = "../controllers/logout.php";
            }
        });
    </script>
</body>
</html>