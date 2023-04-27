# Sudoku

Le sujet de notre projet transversal est de créer un sudoku en Php

## parcours utilisateur

- à l'entrer de notre application le visiteur vera une liste décroisante des utilisateurs avant lui qui ont joué au sudoku (pour chaque utilisateur, son reccord personnel marquet à droite)

- le visiteur peut se créer un compte et se connecter à ce compte

- une fois connecté, le visiteur peut créer une partie de sudoku

- une fois la partie créée, le visiteur peut jouer à la partie de sudoku

- une fois la partie terminée, le visiteur peut voir son score et le comparer à son reccord personnel

- le visiteur peut se déconnecter de son compte

## fonctionalités implémentées

### Compte utilisateur

tout utilisateur doit pouvoir se créer un compte et se connecter à ce compte

- [x] Création d'un compte
- [x] Connexion à un compte
- [x] Déconnexion d'un compte

### Creeation de partie de sudoku

tout utilisateur doit pouvoir créer une partie de sudoku

- [x] Création d'une partie de sudoku
- [x] Affichage d'une partie de sudoku
- [x] Affichage d'une partie de sudoku avec solution
- [x] Affichage d'une partie de sudoku avec solution et aide
- [x] Affichage d'une partie de sudoku avec solution et aide et vérification de la validité de la grille
- [x] Affichage d'une partie de sudoku avec solution et aide et vérification de la validité de la grille et affichage du score

### Génération de grille de sudoku valide

- [x] Création d'un tableau de 9x9
- [x] Remplissage aléatoire du tableau
- [x] Affichage du tableau
- [x] Vérification de la validité du tableau
- [x] Génération d'un tableau valide
- [x] Génération d'un tableau valide avec une solution

## Structure de la base de données

### Table `users`

    -   id | int
    -   first_name | string
    -   last_name | string
    -   password | string
    -   email | string (unique)
    -   created_at | datetime (default: now)
    -   updated_at | datetime (default: now)

### Table `grids`

    -   id | int
    -   user_id | int
    -   grid | string
    -   solution | string
    -   created_at | datetime (default: now)
    -   updated_at | datetime (default: now)

### table `user_attempts`

    -   id | int
    -   user_id | int
    -   attempt | int
    -   created_at | datetime (default: now)
    -   updated_at | datetime (default: now)

# comment installer le projet

## prérequis

- avoir un serveur web (apache, nginx, etc...)
- avoir php 8.1 ou supérieur
- avoir composer

## installation

- cloner le projet
- se placer dans le dossier du projet
- lancer la commande `composer install`
- copier le fichier `.env.example` et le renommer en `.env`
- modifier le fichier `.env` pour y mettre les informations de connexion à la base de données
- lancer la commande `php artisan migrate`
- lancer la commande `php artisan serve`
- ouvrir un navigateur et aller à l'adresse `http://localhost:8000`
