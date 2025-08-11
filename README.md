# 🚀 SecurePass - Guide d'Installation avec Docker

Ce guide explique **clairement et étape par étape** comment installer et exécuter SecurePass avec Docker, pour que n’importe qui puisse lancer l’application sur sa machine locale sans difficulté.

---

## 📋 Prérequis

Avant de commencer, assurez-vous d’avoir :

- **Docker** (v20.10 ou plus récent)
- **Docker Compose** (v2.5 ou plus récent)
- **2 Go de RAM** disponibles
- **Ports disponibles** :
  - `8000` → Application
  - `8080` → phpMyAdmin

---

## 🛠️ Installation

### 1️⃣ Cloner le projet

```bash
git clone https://github.com/X-jonica/docker_pass_php.git
cd securepass
```

### 2️⃣ Configurer l’environnement

Créez un fichier `.env` à la racine du projet (vous pouvez copier `.env.example` si disponible) et adaptez les valeurs :

```ini
# Paramètres MySQL
DB_ROOT_PASSWORD=votre_mot_de_passe_complexe
DB_NAME=securepass_db
DB_USER=securepass_user
DB_PASSWORD=autre_mot_de_passe_complexe

# Paramètres applicatifs (optionnels)
APP_ENV=prod
APP_DEBUG=false
```

💡 **Astuce** : Utilisez des mots de passe forts pour plus de sécurité.

---

### 3️⃣ Lancer les services

Exécutez :

```bash
docker compose up -d
```

Cette commande :

- Télécharge et construit les images nécessaires
- Lance les conteneurs en arrière-plan
- Configure automatiquement la base de données

---

## 🌐 Accéder aux services

| Service     | URL                                            | Identifiants                                                                    |
| ----------- | ---------------------------------------------- | ------------------------------------------------------------------------------- |
| Application | [http://localhost:8000](http://localhost:8000) | Aucun                                                                           |
| phpMyAdmin  | [http://localhost:8080](http://localhost:8080) | Utilisateur : `root`<br>Mot de passe : valeur de `DB_ROOT_PASSWORD` dans `.env` |
| MySQL       | Host : `db` (interne Docker)                   | Utilisateur : valeur de `DB_USER`<br>Mot de passe : valeur de `DB_PASSWORD`     |

---

## 🔍 Vérifier le bon fonctionnement

### 1️⃣ Voir l’état des conteneurs

```bash
docker compose ps
```

Vous devez voir **3 services** avec l’état `running`.

---

### 2️⃣ Consulter les logs

```bash
docker compose logs -f web
```

Cela permet de suivre les messages de l’application en temps réel.

---

## 🗃️ Utilisation de la base de données

### Accès via phpMyAdmin

- Ouvrir : [http://localhost:8080](http://localhost:8080)
- Identifiants :
  - **Utilisateur** : `root`
  - **Mot de passe** : valeur de `DB_ROOT_PASSWORD` dans `.env`

---
