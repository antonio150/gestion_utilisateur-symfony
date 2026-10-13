# Gestion Utilisateur

Application Symfony 7.4 dédiée à la gestion des utilisateurs. Elle permet d'afficher la liste des utilisateurs, d'ajouter un nouvel utilisateur, de modifier ses informations et de le supprimer.

## Fonctionnalités

- Liste des utilisateurs
- Ajout d'un utilisateur
- Modification d'un utilisateur
- Suppression d'un utilisateur
- Hashage sécurisé des mots de passe
- Intégration Doctrine ORM et Twig

## Stack technique

- PHP 8.2+
- Symfony 7.4
- Doctrine ORM
- Twig
- PHPUnit
- MariaDB / MySQL / PostgreSQL (selon votre configuration)

## Structure du projet

- `src/Controller/` : contrôleurs Symfony
- `src/Entity/` : entités Doctrine
- `src/Form/` : formulaires
- `templates/` : vues Twig
- `config/` : configuration Symfony
- `public/` : point d'entrée web
- `migrations/` : migrations Doctrine
- `tests/` : tests PHPUnit

## Prérequis

Avant de lancer le projet, vérifiez que vous avez installé :

- PHP 8.2 ou plus
- Composer
- Un moteur de base de données compatible (MariaDB/MySQL ou PostgreSQL)
- Symfony CLI (optionnel mais recommandé)

## Installation

1. Cloner le dépôt :

```bash
git clone <url-du-repo>
cd app_new_symfony
```

2. Installer les dépendances :

```bash
composer install
```

3. Configurer la base de données dans le fichier `.env` :

```env
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/gestion_user?serverVersion=8.0&charset=utf8mb4"
```

Ou pour PostgreSQL :

```env
DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
```

4. Créer la base de données :

```bash
php bin/console doctrine:database:create
```

5. Appliquer les migrations :

```bash
php bin/console doctrine:migrations:migrate
```

6. Démarrer le serveur Symfony :

```bash
symfony serve
```

Ou, sans Symfony CLI :

```bash
php -S localhost:8000 -t public
```

## Accès à l'application

Une fois le serveur démarré, ouvrez l'URL suivante :

```text
http://localhost:8000/user/
```

Les principales routes du projet sont :

- `GET /user/` : liste des utilisateurs
- `GET /user/add` : formulaire d'ajout
- `GET /user/update/{id}` : formulaire de modification
- `GET /user/delete/{id}` : suppression d'un utilisateur

## Tests

Pour lancer les tests :

```bash
php bin/phpunit
```

## Variables d'environnement

Le projet utilise un fichier `.env` pour la configuration locale. Vous pouvez créer un fichier `.env.local` pour surcharger votre configuration sans modifier `.env`.

## Contribution

Les contributions sont les bienvenues. Avant de proposer une modification, pensez à vérifier le bon fonctionnement du projet avec les tests et à garder le code cohérent avec le style Symfony.
