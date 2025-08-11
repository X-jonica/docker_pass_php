<?php
require_once '../config/config.php';
require_once '../models/Password.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error_message'] = "Vous devez être connecté pour effectuer cette action.";
        header("Location: ../views/login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // ➕ AJOUTER
        if ($action === 'add') {

            if (!empty($_POST['site_name']) && !empty($_POST['login']) && !empty($_POST['password'])) {

                $site_name = trim($_POST['site_name']);
                $site_url  = trim($_POST['site_url'] ?? '');
                $login     = trim($_POST['login']);
                $password  = $_POST['password'];
                $notes     = trim($_POST['notes'] ?? '');

                $success = Password::add($user_id, $site_name, $site_url, $login, $password, $notes);

                $_SESSION[$success ? 'success_message' : 'error_message'] =
                    $success ? "✅ Mot de passe enregistré avec succès." : "❌ Une erreur s'est produite lors de l'enregistrement.";
            } else {
                $_SESSION['error_message'] = "❌ Veuillez remplir tous les champs obligatoires.";
            }

            header("Location: ../views/dashboard.php");
            exit;
        }

        // ✏️ MODIFIER
        elseif ($action === 'update') {

            if (!empty($_POST['id']) && !empty($_POST['site_name']) && !empty($_POST['login']) && !empty($_POST['password'])) {

                $id        = intval($_POST['id']);
                $site_name = trim($_POST['site_name']);
                $site_url  = trim($_POST['site_url'] ?? '');
                $login     = trim($_POST['login']);
                $password  = $_POST['password'];
                $notes     = trim($_POST['notes'] ?? '');

                $success = Password::update($id, $user_id, $site_name, $site_url, $login, $password, $notes);

                $_SESSION[$success ? 'success_message' : 'error_message'] =
                    $success ? "✅ Mot de passe mis à jour avec succès." : "❌ Échec de la mise à jour.";
            } else {
                $_SESSION['error_message'] = "❌ Informations incomplètes pour la mise à jour.";
            }

            header("Location: ../views/dashboard.php");
            exit;
        }

        // ❌ SUPPRIMER
        elseif ($action === 'delete') {

            if (!empty($_POST['id'])) {
                $id = intval($_POST['id']);

                $success = Password::delete($id, $user_id);

                $_SESSION[$success ? 'success_message' : 'error_message'] =
                    $success ? "✅ Mot de passe supprimé." : "❌ Impossible de supprimer cet enregistrement.";
            } else {
                $_SESSION['error_message'] = "❌ ID manquant pour la suppression.";
            }

            header("Location: ../views/dashboard.php");
            exit;
        }

        // ❓ Action inconnue
        else {
            $_SESSION['error_message'] = "❌ Action non reconnue.";
            header("Location: ../views/dashboard.php");
            exit;
        }
    }

} else {
    $_SESSION['error_message'] = "❌ Méthode non autorisée.";
    header("Location: ../views/dashboard.php");
    exit;
}
