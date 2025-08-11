<?php
require_once '../config/config.php';

class User {
    public static function register($username, $email, $password) {
        global $pdo;

        // Vérifier si l'email existe déjà
        $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);
        if ($check->fetch()) return false;

        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([
            $username,
            $email,
            password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public static function login($email, $password) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // 🔍 Récupérer un utilisateur par ID
    public static function getById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, username, email, password FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }


    // ✏️ Modifier un compte utilisateur
    public static function update($id, $username, $email, $password = null) {
        global $pdo;

        if ($password) {
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
            return $stmt->execute([
                $username,
                $email,
                password_hash($password, PASSWORD_DEFAULT),
                $id
            ]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
            return $stmt->execute([$username, $email, $id]);
        }
    }

    // 🗑 Supprimer un compte utilisateur
    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
