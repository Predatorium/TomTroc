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
        // Pages accessibles à tous.
        case 'home':
            $homeController = new HomeController();
            $homeController->showHome();
            break;

        case 'books':
            $booksController = new BooksController();
            $booksController->showBooks();
            break;

        case 'detailBook':
            $booksController = new BooksController();
            $booksController->showDetailBook();
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

        case 'account':
            $accountController = new AccountController();
            $accountController->showAccount();
            break;

        case 'connectUser':
            $accountController = new AccountController();
            $accountController->connectUser();
            break;

        case 'disconnectUser':
            $accountController = new AccountController();
            $accountController->disconnectUser();
            break;

        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}