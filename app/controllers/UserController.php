<?php
require_once '../config/config.php';
require_once '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action'])) {

        // Inscription
        if ($_POST['action'] === 'register') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if (User::register($username, $email, $password)) {
                $_SESSION['message'] = "Inscription réussie. Connectez-vous.";
                header("Location: ../views/login.php");
            } else {
                $_SESSION['error'] = "Erreur lors de l'inscription. Email peut-être déjà utilisé.";
                header("Location: ../views/register.php");
            }
            exit;

        // Connexion
        } elseif ($_POST['action'] === 'login') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $user = User::login($email, $password);
            if ($user) {
                // Stockage session avec user_id et username séparés
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                $_SESSION['message'] = "Connexion réussie. Bienvenue ".$user['username']." !";
                header("Location: ../views/dashboard.php");
            } else {
                $_SESSION['error'] = "Email ou mot de passe incorrect";
                header("Location: ../views/login.php");
            }
            exit;

        // Mise à jour du mot de passe
        } elseif ($_POST['action'] === 'update_password') {
            $id = intval($_POST['id']);
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Récupérer user actuel
            $user = User::getById($id);

            if (!$user) {
                $_SESSION['error'] = "Utilisateur introuvable.";
                header("Location: ../views/edit_profile.php");
                exit;
            }

            // Vérifier mot de passe actuel
            if (!password_verify($currentPassword, $user['password'])) {
                $_SESSION['error'] = "Mot de passe actuel incorrect.";
                header("Location: ../views/edit_profile.php");
                exit;
            }

            // Vérifier que nouveau mot de passe = confirmation
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = "Les nouveaux mots de passe ne correspondent pas.";
                header("Location: ../views/edit_profile.php");
                exit;
            }

            // Mettre à jour le mot de passe
            if (User::update($id, $user['username'], $user['email'], $newPassword)) {
                $_SESSION['message'] = "Mot de passe mis à jour avec succès.";
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour du mot de passe.";
            }

            header("Location: ../views/edit_profile.php");
            exit;

        // Mise à jour du profil (nom + email)
        } elseif ($_POST['action'] === 'update_profile') {
            $id = intval($_POST['id']);
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);

            if (User::update($id, $username, $email)) {
                // Mettre à jour les infos de session
                $_SESSION['username'] = $username;
                $_SESSION['message'] = "Profil mis à jour avec succès.";
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour du profil.";
            }
            header("Location: ../views/edit_profile.php");
            exit;

        // Suppression de compte
        } elseif ($_POST['action'] === 'delete_account') {
            $id = intval($_POST['id']);

            if (User::delete($id)) {
                session_destroy(); // On détruit la session pour déconnecter l'utilisateur
                header("Location: ../views/login.php");
            } else {
                $_SESSION['error'] = "Erreur lors de la suppression du compte.";
                header("Location: ../views/edit_profile.php");
            }
            exit;
        }
    }
}
