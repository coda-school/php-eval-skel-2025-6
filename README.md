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

## Fonctionnalités additionnelles 

- Tweets Populaires

## Utilisation de l'IA

De l'intelligence artificielle a été utilisée pour:
- Créer le CSS
- Aide pour l'écriture du fichier AppFixtures.php
