-- Active le mode strict pour MySQL
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Création de la table 'users'
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) UNIQUE NOT NULL,
  `password` TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Création de la table 'passwords' avec clé étrangère
CREATE TABLE IF NOT EXISTS `passwords` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `site_name` VARCHAR(100) NOT NULL,
  `site_url` VARCHAR(255),
  `login` VARCHAR(100) NOT NULL,
  `password_encrypted` TEXT NOT NULL,
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Optionnel : Données de test pour démo
INSERT INTO `users` (`username`, `email`, `password`) VALUES
('admin', 'admin@example.com', '$2y$10$VPLtoqVeEHQ5AYQqGp.XXO7ZB4UzQ7sHl7tC5RrlvJX9yR1sQdQ0a'), -- motdepasse: "Admin123!"
('user1', 'user1@example.com', '$2y$10$NkQ5YjZhZjE3YjQwZWMwO.9kZJKlQWJlYWJlYWJlYWJlYWJlYWE'); -- motdepasse: "Password123"

INSERT INTO `passwords` (`user_id`, `site_name`, `site_url`, `login`, `password_encrypted`, `notes`) VALUES
(1, 'Gmail', 'https://mail.google.com', 'admin@gmail.com', 'encrypted_gmail_password', 'Compte principal'),
(1, 'GitHub', 'https://github.com', 'dev_user', 'encrypted_github_password', 'Accès professionnel'),
(2, 'Netflix', 'https://netflix.com', 'family@mail.com', 'encrypted_netflix_password', 'Profil enfant');