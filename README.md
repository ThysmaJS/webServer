# Projet Web Server avec JWT Authentication

Ce projet est une application web sécurisée utilisant JWT (JSON Web Tokens) pour l'authentification, avec une architecture basée sur Docker.

## 🚀 Technologies Utilisées

- **Frontend** : HTML, CSS, JavaScript
- **Backend** : PHP
- **Base de données** : PostgreSQL
- **Conteneurisation** : Docker & Docker Compose
- **Sécurité** : JWT, Bcrypt pour le hachage des mots de passe

## 📋 Prérequis

- Docker
- Docker Compose
- Un navigateur web moderne

## 🛠️ Installation

1. Clonez le repository :
```bash
git clone [URL_DU_REPO]
cd [NOM_DU_DOSSIER]
```

2. Lancez les conteneurs Docker :
```bash
docker-compose up -d
```

## 🔧 Configuration

Le projet utilise plusieurs conteneurs Docker :

- **Apache** : Serveur web (port 443)
- **PostgreSQL** : Base de données (port 5432)

Les fichiers de configuration se trouvent dans :
- `apache/` : Configuration Apache et fichiers PHP
- `postgresql/` : Scripts SQL et configuration de la base de données

## 🔐 Identifiants par défaut

- **Utilisateur** : admin
- **Mot de passe** : password123

## 📁 Structure du Projet

```
.
├── apache/
│   ├── html/
│   │   ├── jwt/
│   │   │   ├── login.html
│   │   │   ├── login.php
│   │   │   └── verify.php
│   │   └── index.html
│   └── Dockerfile
├── postgresql/
│   ├── setup-bdd.sql
│   └── Dockerfile
├── docker-compose.yml
└── README.md
```

## 🔍 Fonctionnalités

- Authentification sécurisée avec JWT
- Stockage sécurisé des mots de passe avec Bcrypt
- Interface utilisateur responsive
- API RESTful pour l'authentification

## 🚨 Sécurité

- Les mots de passe sont hachés avec Bcrypt
- Les tokens JWT sont signés avec une clé secrète
- Les connexions à la base de données sont sécurisées
- HTTPS est configuré par défaut

## 🐛 Débogage

Pour voir les logs :
```bash
docker-compose logs -f
```

## 🧹 Nettoyage

Pour arrêter et supprimer les conteneurs :
```bash
docker-compose down -v
```

## 📝 Notes

- Le projet utilise le port 443 pour HTTPS
- La base de données est initialisée automatiquement au démarrage
- Les certificats SSL sont auto-signés (à remplacer en production)

## ⚠️ Avertissement

Ce projet est conçu à des fins éducatives. En production, assurez-vous de :
- Remplacer les certificats SSL auto-signés
- Utiliser des mots de passe forts
- Configurer correctement les paramètres de sécurité
- Mettre à jour régulièrement les dépendances 