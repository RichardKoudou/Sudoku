# Sudoku

Le sujet de notre projet transversal est de créer un sudoku en Php

## Notre Parcours Utilisateur

-   à l'entrer de notre application le visiteur vera une liste décroisante des utilisateurs avant lui qui ont joué au sudoku (pour chaque utilisateur, son reccord personnel marquet à droite)

-   le visiteur peut se créer un compte et se connecter à ce compte (ou lancer une partie sans se connecter. Il n'aura donc pas accès à certains éléments comme l'historique de ses parties, son meilleur record et son classement parmi les autres utilisateurs)

-   une fois connecté, le visiteur peut créer une partie de sudoku

-   une fois la partie créée, le visiteur peut jouer à la partie de sudoku

-   une fois la partie terminée, le visiteur peut voir son score et le comparer à son reccord personnel

-   le visiteur peut se déconnecter de son compte

## Fonctionalités implémentées

### Compte utilisateur

tout utilisateur doit pouvoir se créer un compte et se connecter à ce compte

-   [x] Création d'un compte
-   [x] Connexion à un compte
-   [x] Déconnexion d'un compte
-   [x] Affichage de l'historique des parties d'un utilisateur
-   [x] Affichage du meilleur score d'un utilisateur
-   [x] Affichage du classement d'un utilisateur parmi les autres utilisateurs

### Génération de grille de sudoku valide

-   [x] Création d'un tableau de 9x9
-   [x] Remplissage aléatoire du tableau
-   [x] Affichage du tableau
-   [x] Vérification de la validité du tableau
-   [x] Génération d'un tableau valide
-   [x] Génération d'un tableau valide avec une solution

### Creeation de partie de sudoku

-   [x] Création d'une partie de sudoku avec une grille valide et une solution valide et un score de 0 et un temps de 0 pour un utilisateur connecté
-   [x] Affichage d'une partie de sudoku
-   [x] Vérification de la validité de la grille et affichage du score
-   [x] Affichage de la solution d'une partie de sudoku

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

## Comment installer le projet

### prérequis

-   avoir un serveur web (apache, nginx, etc...)
-   avoir php 8.1 ou supérieur
-   avoir composer

### installation

-   cloner le projet
-   se placer dans le dossier du projet
-   lancer la commande `composer install`
-   copier le fichier `.env.example` et le renommer en `.env`
-   générer une clé d'application avec la commande `php artisan key:generate`
-   modifier le fichier `.env` pour y mettre vos informations de base de données
-   lancer la commande `php artisan migrate`
-   lancer la commande `php artisan serve`
-   ouvrir un navigateur et aller à l'adresse `http://localhost:8000`

## Liens utiles

-   [simple sudoku codepen](https://codepen.io/CYass/pen/qwjbRr)
-   [sudoku complet](https://codepen.io/gerrardcss/details/rNGLRdp)
-   [sudoku avec beau design](https://codepen.io/flavio_amaral/pen/oNGPqEN)
-   [sudoku avec une interaction interressante](https://codepen.io/dovid1234/pen/PZbmMx)
