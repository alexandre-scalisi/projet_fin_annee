# Anime project

## Liens
Application en production sur [heroku](http://anime-project-alexlemia13.herokuapp.com/)
Scrapper que j'ai créé pour remplir la base de donnée: [Mon github](https://github.com/alexandre-scalisi/anime-scraper)

## Présentation
Voici mon projet de fin d'année pour ma formation à l'AFPA (TP Développeur Web / Web Mobile obtenu le 26/07/21). 

C'est un site de streaming d'anime qui utilise des vidéos hébergées sur des sites de streaming légaux.

Les anime sont rangés par catégories et on peut les noter, les commenter ou s'abonner pour recevoir une notification lorsqu'un nouvel épisode sort si on est connecté.

## Comptes
Identifiants créés dans le seeder.
N'hésitez pas à vous connecter en tant qu'admin pour voir la partie admin du site ou à créer votre compte

| Pseudo | Email           | Mot de passe |
|--------|-----------------|--------------|
| admin  | admin@admin.com | password     |
| user   | user@user.com   | password     |

## Installation

### Requis
* PHP (conseillé >= 7.3)
* composer
* Base de données (seulement testé avec mysql)
  
### Commandes

Renommez le fichier .env.example en .env puis suivez les instructions en commentaires dans le fichier
```bash
mv .env.example .env
```

Installez tous les paquets spécifiés dans le fichier composer.json et générez l’autoload
```bash
composer install
```

Remplissez la base de données avec le seeder
```bash
php artisan migrate:fresh --seed
```

Puis démarrez le serveur
```bash
php artisan serve
```
