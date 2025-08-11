# Gestionnaire de Mots de Passe

## Description

Application web permettant à des utilisateurs de s’inscrire, se connecter et gérer leurs mots de passe personnels en toute sécurité.

Les mots de passe des sites sont stockés chiffrés en base de données et sont déchiffrés uniquement lors de l’affichage.

---

## Fonctionnalités clés

- Inscription et connexion sécurisées
- Ajout, modification et suppression des mots de passe personnels
- Chiffrement AES-256 des mots de passe stockés

---

## Installation et utilisation

1. Cloner le projet
2. Configurer la base de données dans `config.php`
3. Importer le schéma SQL
4. Lancer le serveur PHP en ligne de commande :

```bash
php -S localhost:8000
```
