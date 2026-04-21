<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages d'accueil.
        case 'home':
            $homeController = new HomeController();
            $homeController->showHome();
            break;
        
        // Pages en lien avec les livres.
        case 'books':
            $booksController = new BooksController();
            $booksController->showBooks();
            break;

        case 'detailBook':
            $booksController = new BooksController();
            $booksController->showDetailBook();
            break;

        case 'newBook': 
            $booksController = new BooksController();
            $booksController->showNewBook();
            break;

        case 'editBook':
            $booksController = new BooksController();
            $booksController->showEditBook();
            break;
        
        case 'addBook': // requet sql pour ajouter un livre.
            $booksController = new BooksController();
            $booksController->addBook();
            break;

        case 'updateBook': // requet sql pour mettre à jour un livre.
            $booksController = new BooksController();
            $booksController->updateBook();
            break;

        case 'deleteBook': // requet sql pour supprimer un livre.
            $booksController = new BooksController();
            $booksController->deleteBook();
            break;

        // Pages en lien avec les comptes et profil des utilisateurs.
        case 'account':
            $accountController = new AccountController();
            $accountController->showAccount();
            break;

        case 'userProfil':
            $accountController = new AccountController();
            $accountController->showUserProfil();
            break;
            
        case 'addUser':
            $accountController = new AccountController();
            $accountController->addUser();
            break;

        case 'login':
            $accountController = new AccountController();
            $accountController->showLogin();
            break;

        case 'register':
            $accountController = new AccountController();
            $accountController->showRegister();
            break;

        case 'connectUser':
            $accountController = new AccountController();
            $accountController->connectUser();
            break;

        case 'disconnectUser':
            $accountController = new AccountController();
            $accountController->disconnectUser();
            break;
        
        // Pages en lien avec la messagerie.
        case 'messaging':
            $msgController = new MessagingController();
            $msgController->showMessaging();
            break;
            
        case 'addConversation': // requet sql qui verifie et ajoute des conversations.
            $msgController = new MessagingController();
            $msgController->addConversation();
            break;
        
        // Requete sql par javascript.

        case 'getBooks': // requet qui permet de recupérer tous les livres disponibles avec une recherche sur les noms/auteurs.
            $booksController = new BooksController();
            $booksController->getBooks();
            break;

        case 'getConversation': // requet qui permet de recupérer une conversation précise.
            $msgController = new MessagingController();
            $msgController->getConversation();
            break;

        case 'getConversations': // requet qui permet de recupérer toute nos conversation.
            $msgController = new MessagingController();
            $msgController->getConversations();
            break;

        case 'getMessages': // requet qui permet de recupérer les messages d'une conversation.
            $msgController = new MessagingController();
            $msgController->getMessages();
            break;

        case 'sendMessage': // requet qui permet d'envoyer un message'.
            $msgController = new MessagingController();
            $msgController->sendMessage();
            break;

        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}