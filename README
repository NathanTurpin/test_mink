# Mink test
Test technique pour une ferme fictive :


## Description

Une ferme familiale contacte l’agence pour la création d’une plateforme de vente de
bétail auprès des particuliers.
Pour cette V1, la ferme décide d’afficher publiquement une liste de son bétail en vente.
Le particulier pourra trier et filtrer cette liste et appeler directement la ferme pour
acheter un animal.
Pour administrer cette liste, la ferme aura un accès à un backoffice qui lui permettra
de créer, éditer et supprimer les animaux dont-elle dispose.

## Technologies

Énumère les technologies utilisées dans ton projet. Par exemple :

- **Frontend** : Vue.js 3, Tailwind CSS
- **Backend** : Symfony 7.1, PHP 8.2.12
- **Base de données** : MySQL 
- **Autres outils** : Composer, npm

## Installation

### Prérequis

Assure-toi que les prérequis sont installés sur la machine locale, comme Node.js, Composer, PHP, etc.

- PHP >= 8.1
- Node.js >= 20.0
- Composer
- VSymfony cli

### Étapes d'installation

1. **Clonez le repository** :
    ```bash
    git clone https://github.com/NathanTurpin/test_mink.git
    ```

2. **Installez les dépendances backend** :
    ```bash
    composer install
    ```

3. **Installez les dépendances frontend** :
    ```bash
    npm install
    ```

4. **Configurer votre base de données** :
    Configurer ta base de données dans `.env` ou `.env.local`. Par exemple :

    ```
    DATABASE_URL="mysql://username:password@127.0.0.1:3306/nom_base"
    ```

5. **Lancer le serveur local** :
    - **Backend (Symfony)** :
      ```bash
      symfony serve
      ```

    - **Frontend (Vue.js)** :
      ```bash
      npm run watch
      ```

6. **Accéder à l'application** :
    Une fois les serveurs en cours d'exécution, tu peux accéder à ton application dans ton navigateur à `http://localhost:8000`.

## Création DB
  ```bash
    symfony console doctrine:database:create
  ```
lancer les migrations :
  ```bash
    symfony console doctrine:migrations:migrate
  ```

## Utilisation

Aller dans le terminal et lancer la commande suivante pour créer un utilisateur ADMIN :
  Sans cli : 
  ```bash
  php bin/console create-user john.doe@example.com anotherpassword ROLE_USER ROLE_ADMIN
  ```
  Avec symfony CLI  
  ```bash
  symfony console create-user john.doe@example.com anotherpassword ROLE_USER ROLE_ADMIN
  ```
Vous pouvez maintenant vous connecter en cliquant sur l'icon profil en haut à droite.
Vous pouvez ensuite créer, editer et supprimer des types, des races et des annimaux via l'interface et aller voir les produits dans la home page "/".