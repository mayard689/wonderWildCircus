# Application
Cette Application est la maquette d'un site WEB pour un cirque.
Elle permet de présenter la philosophie du cirrque, sa troupe et les dates de représentation.
L'utilisateur peut se connecter en administrateur pour gerer la troupe et les date de spectcle. Il peut aussi se connecter en abonné pour verifier les dates de reservation.

# Technologie
Cette application est écrité en PHP7.2, HTML, CSS et quelques ligens de Javascript.

# Installation
Pour l'installer :
* Verifiez que PHP, mysql, Composer et Yarn sont installés sur votre machine  
* Clonez le projet github  
* Executez composer install  
* Executer yarn install
* Configurer les informations de base de donnée dans le fichier env.local dans le dossier public
* Configurer les information de messagerie, toujours dans le fichier env.local
* Executez la commande bin/console doctrine:database:create pour creer la base de donnée puis bin/console doctrine:schema;update --force pour construire les tables
* Enfin, executez bin/console doctrine:fixture:load pour creer un compte administrateur et un compte abonné ainsi qu'une troupe fictive

# Execution
Pour lancer l'application :
* Lancez votre serveur dans le dossier public, par exmeple en executant la commande symfony server:start depuis le dossier racine de l'application. 
* Verifiez depuis quelle IP et sur quel port le serveur écoute
* Lancer le copilateur d'asset en executant yarn encore dev --watch depuis le dossier racine de l'application
* Connectez vous à l'adresse IP et au port de votre serveur grâce au navigateur de votre choix
