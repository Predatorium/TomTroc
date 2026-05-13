## Site d'échange de livre TomTroc

## Pour utiliser ce projet : 

- Commencer par cloner le projet. 
- installez le projet chez vous, dans un dossier exécuté par un serveur local (type MAMP, WAMP, LAMP, etc...)
- Une fois installé chez vous, créez un base de données vide appelée : "tomtroc2"
- Importez le fichier tomtroc2.sql dans votre base de données.

## Lancez le projet ! 

Le fichier config.php contient notamment les informations de connexion à la base de données. 

## Problèmes courants :

Il est possible que la librairie intl ne soit pas activée sur votre serveur par défaut. Cette librairie sert notamment à traduire les dates en francais. 
Dans ce cas, vous pouvez soit utiliser l'interface de votre serveur local pour activer l'extention (wamp), soit aller modifier directement le fichier php.ini. 

Ce projet a été réalisé avec PHP 8.2. Bien que d'autres versions de PHP puissent fonctionner, il n'est pas garanti que le projet fonctionne avec des versions antérieures.

## Copyright : 

Projet réaliser dans le cadre de la formation full-stack d'Openclassrooms.