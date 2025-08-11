<?php
require_once '../config/config.php';

// Supprime toutes les variables de session
$_SESSION = [];

// Détruit la session côté serveur
session_destroy();

// Supprime le cookie de session (facultatif mais recommandé)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirige vers la page de login
header('Location: ../views/login.php');
exit;
