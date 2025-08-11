<?php
// Gestion des sessions
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Chargement strict du .env (sans fallback)
$env = parse_ini_file('../.env');

// Validation des variables REQUISES
$requiredVars = ['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD', 'DB_CHARSET'];
foreach ($requiredVars as $var) {
    if (!isset($env[$var])) {
        die("❌ Configuration manquante dans .env : $var");
    }
}

// Assignation directe
$host = $env['DB_HOST'];
$db   = $env['DB_NAME'];
$user = $env['DB_USER'];
$pass = $env['DB_PASSWORD'];
$charset = $env['DB_CHARSET'];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    if (!isset($_SESSION['db_connected'])) {
        $_SESSION['db_connected'] = true;
        $_SESSION['success_message'] = "✅ Connexion DB réussie !";
    }

} catch (PDOException $e) {
    $_SESSION['error_message'] = "❌ Erreur DB : " . htmlspecialchars($e->getMessage());
}