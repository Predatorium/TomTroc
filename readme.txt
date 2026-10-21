# TomTroc

Site d'échange de livres pour une association de partage de livres : les membres publient leurs livres, consultent ceux des autres et se contactent par messagerie. Projet réalisé en PHP dans le cadre de la formation full stack d'OpenClassrooms.

![Page d'accueil](docs/accueil.png)
<!-- À ajouter : 3 ou 4 captures dans docs/ (accueil, liste des livres, compte, messagerie) -->

## Fonctionnalités

- Inscription, connexion et déconnexion (authentification par cookie)
- Page de compte et mise à jour du profil
- Profil public d'un membre
- Livres : liste avec recherche par titre ou auteur, page de détail, ajout, modification et suppression
- Messagerie entre membres : conversations, envoi de messages, compteur de conversations non lues
- Validation du formulaire de connexion et récupération des données en JavaScript, sans recharger la page

## Stack technique

- **PHP 8.2**, sans framework, en architecture **MVC**
- Base de données SQL (script `tomtroc2.sql`)
- JavaScript pour les échanges asynchrones (recherche de livres, messagerie, validation de formulaire)

## Architecture

```
index.php        Point d'entrée et routeur (paramètre ?action=...)
config/          Configuration et chargement automatique des classes
controllers/     HomeController, BooksController, AccountController, MessagingController
models/          Accès aux données
services/        Services partagés
views/           Pages affichées
public/          Ressources publiques
tomtroc2.sql     Structure et données de la base
```

Chaque `action` reçue par `index.php` appelle le contrôleur et la méthode correspondants (`books`, `detailBook`, `addBook`, `login`, `messaging`, `sendMessage`…). Une action inconnue affiche une page d'erreur.

## Lancer le projet

Prérequis : PHP 8.2 avec l'extension `intl` (utilisée pour afficher les dates en français), un serveur local (MAMP, WAMP, LAMP…) et une base SQL.

1. Clone le dépôt dans le dossier servi par ton serveur local :

   ```bash
   git clone https://github.com/Predatorium/TomTroc.git
   ```

2. Crée une base de données vide nommée `tomtroc2`.
3. Importe le fichier `tomtroc2.sql` dans cette base.
4. Vérifie les informations de connexion à la base dans `config/config.php`.
5. Ouvre le site depuis ton serveur local.

### Problème courant

Si les dates ne s'affichent pas correctement, l'extension `intl` n'est probablement pas activée : active-la depuis l'interface de ton serveur local (WAMP par exemple) ou dans le fichier `php.ini`.

## Choix et apprentissages

- Architecture MVC écrite à la main : routeur, contrôleurs, modèles, vues et services.
- Requêtes asynchrones pour la messagerie et la recherche, avec des actions dédiées côté serveur.
- Gestion des erreurs centralisée dans le routeur.

Ce projet et mon premier ou j'ai conçu un site en entier, j'ai créer tout le systeme de routing en Php, et un systeme de messagerie notamment.

## Auteur

Laurent Canonge · [GitHub](https://github.com/Predatorium) · [LinkedIn à ajouter]
