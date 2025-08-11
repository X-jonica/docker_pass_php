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

Un fichier `.env` est déjà présent dans app/.env
⚠️ **Important :** Vous devez **modifier** les valeurs qu’il contient pour que l’application fonctionne sur votre machine.

```ini
# Paramètres MySQL
DB_HOST=votre_host #('localhost par exemple')
DB_NAME=nom_de_la_bd #("manage_password" par exemple)
DB_USER=utilisateur-de-bd #("root" par exemple)
DB_PASSWORD=mot_de_passe_de_votre_bd #("motdepasse123" par exemple)
DB_CHARSET=utf8mb4

# Paramètres applicatifs (optionnels)
APP_ENV=prod
APP_DEBUG=false
```

💡 **Astuce** : Utilisez des mots de passe forts et uniques pour plus de sécurité.

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

| Service     | URL                                            |
| ----------- | ---------------------------------------------- | ------------------------------------------------------------------------------- |
| Application | [http://localhost:8000](http://localhost:8000) |                                                                            |
| phpMyAdmin  | [http://localhost:8080](http://localhost:8080) |
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
