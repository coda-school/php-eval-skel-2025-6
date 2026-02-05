# Projet Archibald - Clone de Twitter

## Lancement de l'application

Avant de lancer l'application, s'assurer que Faker est bien installé.
Si ce n'est pas le cas, taper dans le terminal la commande:
```
composer require fakerphp/faker --dev
```

#### Lancer l'application:

Se mettre à la racine du projet, et taper dans le terminal:
```
docker compose up -d --build --wait
```

Ensuite, rentrer dans le docker avec la commande 
```
docker compose exec php sh
```

Dans le docker, pour obtenir les tables de la base de données, taper la commande:
```
symfony console make:migration
```
Puis appliquer la migration avec:
```
php bin/console doctrine:migrations:migrate
```
Et enfin mettre des données dans la base avec
```
php bin/console doctrine:fixtures:load
```

Une fois ça fait, aller à l'adresse https://localhost et profiter d'Archibald :)

## Description du projet

Notre projet nommé Archibald, est un clone de l'application Twitter.
Sur ce dernier, vous pourrez ainsi vous créer un compte, vous y connecter, vous créer une biographie, poster des "Vers" ainsi que voir les plus populaires ou ceux des personnes que vous suivez.
Vous pouvez accéder à la page d'un vers pour le liker ou le commenter en cliquant sur ce dernier depuis votre feed ou depuis la page d'un utilisateur. Vous accéderez d'ailleurs à la page d'un utilisateur en cliquant sur son nom une fois sur la page d'un de ses vers.


## Fonctionnalités additionnelles 

- Tweets populaires
- Système de commentaires
- Système de likes

## Utilisation de l'IA

De l'intelligence artificielle a été utilisée pour:
- Créer le CSS
- Aide pour l'écriture du fichier AppFixtures.php
