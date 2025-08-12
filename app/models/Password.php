<?php
require_once '../config/config.php';


class Password
{
    // 🔐 Clé de chiffrement pour sécuriser les mots de passe enregistrés
    private static $encryption_key = 'ma_clé_ultra_secrète_à_définir_et_stocker_dans_un_fichier_env';

    // ➕ Ajouter un mot de passe
    public static function add($user_id, $site_name, $site_url, $login, $password, $notes)
    {
        global $pdo;

        $encrypted_password = self::encryptPassword($password);

        $stmt = $pdo->prepare("INSERT INTO passwords (user_id, site_name, site_url, login, password_encrypted, notes)
                               VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $site_name, $site_url, $login, $encrypted_password, $notes]);
    }

    // 📥 Récupérer tous les mots de passe d’un utilisateur
    public static function getAllByUser($user_id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM passwords WHERE user_id = ?");
        $stmt->execute([$user_id]);

        $passwords = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Déchiffrer les mots de passe
        foreach ($passwords as &$password) {
            $password['password_decrypted'] = self::decryptPassword($password['password_encrypted']);
        }

        return $passwords;
    }

    // ✏️ Modifier un mot de passe
    public static function update($id, $user_id, $site_name, $site_url, $login, $password, $notes)
    {
        global $pdo;

        $encrypted_password = self::encryptPassword($password);

        $stmt = $pdo->prepare("UPDATE passwords
                               SET site_name = ?, site_url = ?, login = ?, password_encrypted = ?, notes = ?
                               WHERE id = ? AND user_id = ?");
        return $stmt->execute([$site_name, $site_url, $login, $encrypted_password, $notes, $id, $user_id]);
    }

    // ❌ Supprimer un mot de passe
    public static function delete($id, $user_id)
    {
        global $pdo;

        $stmt = $pdo->prepare("DELETE FROM passwords WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $user_id]);
    }

   // 🔒 Chiffrement AES amélioré
    private static function encryptPassword($password) {
        // Génère un IV aléatoire
        $iv = openssl_random_pseudo_bytes(16);

        // Chiffre le mot de passe
        $encrypted = openssl_encrypt(
            $password,
            'AES-256-CBC',
            self::$encryption_key,
            0,
            $iv
        );

        // Combine IV + texte chiffré et encode en base64
        return base64_encode($iv . $encrypted);
    }

    // 🔓 Déchiffrement AES amélioré
    private static function decryptPassword($encrypted_password) {
        // Décode la chaîne base64
        $data = base64_decode($encrypted_password);

        // Extrait l'IV (16 premiers octets)
        $iv = substr($data, 0, 16);

        // Extrait le texte chiffré
        $encrypted = substr($data, 16);

        // Déchiffre
        return openssl_decrypt(
            $encrypted,
            'AES-256-CBC',
            self::$encryption_key,
            0,
            $iv
        );
    }

    // get le password par id (avec déchiffrement)
    public static function getById(int $id, int $user_id)
    {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM passwords WHERE id = :id AND user_id = :user_id LIMIT 1");
        $stmt->execute(['id' => $id, 'user_id' => $user_id]);
        $entry = $stmt->fetch();

        if ($entry) {
            // Décrypter le mot de passe ici
            $entry['password_decrypted'] = self::decryptPassword($entry['password_encrypted']);
        }

        return $entry;
    }


}
