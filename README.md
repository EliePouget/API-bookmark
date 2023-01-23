# Auteur : Pouget Elie

# TP Introduction API Platform

## Création du projet

Mettre à jour composer : **composer self-update** 

Posséder une version minimale de php 8.0

Création du projet : **symfony new api-bookmark --version 5.4**

Dans le projet créer le quelette de Symfony : **composer require api api-platform/core:^2.7**

Installation des dépendances : **composer require --dev friendsofphp/php-cs-fixer**

## Configuration

Ajouter au script composer :

    "start" : [

        "Composer\\Config::disableProcessTimeout",

        "symfony serve"],

        
    "test:cs" : "php-cs-fixer fix --dry-run",
        
    "fix:cs" : "php-cs-fixer fix",
        
    "test" : "@test:cs",

Modifier la configuration requise minimal **PHP >=8.0**

## Script

**start** : démarre le serveur web local Symfony

**test:cs** : vérifie le code

**fix:cs** : corrige le code

**test** : déclenche test:cs

**db** : Supprime l'ancienne base de donnée et créer une nouvelle, fait la migration puis ajoute des données dedans