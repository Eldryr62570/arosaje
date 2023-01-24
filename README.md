
# A'rosa-je

## Initialisation du projet avec Docker : 

### Information : 

- Fichier docker-compose.yml : Nous ajoutons le serveur mysql, phpMyAdmin et le serveur apache à la liste des services

- Fichier dans les repertoires docker/php/Dockerfile : Nous créons un fichier Dockerfile dans le dossier docker/php pour créer notre image apache php personnalisée

- Fichier dans les répertoires docker/php/vhosts/ vhosts.conf :

### Initialiser Docker :

1. git clone le repository et rentrer dans ce répertoire
2. Lancez la commande 'docker-compose up --build'

<b>Le projet Symfony est déjà créer passer à l'étape 9 directement si le repertoire Arosaje existe déjà .<b>

### Créer un projet Symfony : 

3. Accéder au conteneur Arosaje_symfony et rentrer dans le terminal du conteneur et exécuter la commande
'curl -sS https://get.symfony.com/cli/installer | bash'(symfony CLI : https://symfony.com/download) et la commande 'composer create-project symfony/skeleton:"6.2.*" arosaje' (projet symfony skeleton)
4. L'application Symfony est maintenant accessible sur http://localhost:8741/

### Configurez la connexion Mysql au projet Symfony : 

5. cd sur le repertoire du projet symfony 'arosaje'
6. composer require symfony/orm-pack
7. composer require --dev symfony/maker-bundle

8. A la racine du repo git '.env.exemple' , mettre dans .env du repertoire projet symfony 'Arosaje'

### Vous pouvez maintenant tester votre connexion à la base de données :

9. Lancez la commande si le base de données n'existe pas déjà : 'php bin/console doctrine:database:create'
10. Accéder à l'URL 'http://localhost:8080/' ID : root / MDP : root , Vérifier si la bdd Arosaje_db est bien là .



## Description du projet
L’entreprise “A’rosa-je” aide les particuliers à prendre soin de leurs plantes.
Fondée en 1984 elle a tout d’abord été composée d’une petite équipe de botanistes dans une seule ville et
est maintenant composée de plus de 1500 botanistes répartis sur toute la France qui rendent service aux
propriétaires de plantes de deux façons :
- En allant garder leurs plantes lorsque les propriétaires sont absents
- En prodiguant des conseils d’entretien afin que les propriétaires s’occupent de mieux en mieux de leurs
plantes.
À la suite de la pandémie, elle subit une forte hausse des demandes à laquelle elle n’a pas la capacité de
répondre. Pour cela elle a besoin de développer une option communautaire et automatique.
L’entreprise a donc fait appel à une équipe de design et de marketing qui a proposé de faire une application
permettant aux utilisateurs de faire garder leurs plantes avec un partage de photo et de conseils.
Dans l’application seul les botanistes pourront donner des conseils.
L’entreprise souhaite aussi mettre en place une I.A afin de pouvoir reconnaître les plantes et donner
quelques conseils adaptés préalables.
##Technologie
- Backend Symfony 
- React pour le front
- Utilisation d'api platforme pour le back
## Features du projet 
- Service de location de service pour demander à des particulier de s'occuper des plantes
- Aide en ligne via des profesionnels pour donner des conseils
- Prise de photo de la plante
- Map pour localiser les plantes à s'occuper

## Qui va utiliser ce site ?
- Particulier voulant faire garder une plante
- Particulier voulant garder des plantes
- Profesionnels passionés voulant prodiguer des conseils

## But de ce projet 
- Appli la plus intuitive et agréable à utiliser posssible
- Possibilité que les particulier et profesionnel soit rémunérer pour leurs services moyennant un % taxé par le site 
- L'appli doit permettre une vrai communication entre utilisateurs
