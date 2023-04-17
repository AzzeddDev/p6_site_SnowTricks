# p6_site_SnowTricks
Projet 6 de mon parcours Développeur d'application PHP/Symfony chez OpenClassrooms. Création d'un Site communutaire SnowTrick


Développez de A à Z le site communautaire SnowTricks - [Lien de la formation](https://openclassrooms.com/fr/paths/59-developpeur-dapplication-php-symfony)

# Badge du projet
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/1978642286a8466c8d5d101146c6d5ce)](https://app.codacy.com/gh/AzzeddDev/p6_site_SnowTricks/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)


## Configuration du serveur requise
* MySQL ou MariaDB
* Php 8+
* Composer
* git

## Installation du projet
Cloner le projet sur votre disque dur avec la commande :
```
https://github.com/mdoutreluingne/snowtricks.git
```

Ensuite, effectuez la commande "composer install" depuis le répertoire du projet cloné, afin d'installer les dépendances back nécessaires :
```
composer install
```

Paramétrage et accès à la base de données
```
//Exemple : mysql://root:@127.0.0.1:3306/snowtricks
DATABASE_URL="mysql://nom-d'utilisateur:mdp@localhost:3306/snowtricks"
```

Ensuite à la racine du projet, effectuez la commande ```php bin/console doctrine:database:create``` pour créer la base de données :
```
php bin/console doctrine:migrations:migrate
```

## Envoi des mails
Si vous souhaitez utiliser un serveur de mail afin d'envoyer des mails, vous pouvez le configurer dans le fichier .env à la racine du projet, dans la partie ```MAILER_URL```
Sachez que vous pouvez aussi utiliser [mailtrap.io/](mailtrap.io/) pour simuler l'envoi des mails.

## Lancer le projet
A la racine du projet :
* Pour lancer le serveur de symfony, effectuez un
```
php bin/console server:start
```

### Bravo, le projet SnowTricks est désormais accessible à l'adresse : http://127.0.0.1:8000