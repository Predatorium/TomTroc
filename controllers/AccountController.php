<?php

class AccountController {
    
    /**
     * Affiche la page de connexion.
     * @return void
     */
    public function showLogin() : void
    {
        $view = new View("Inscription");
        $view->render("login");
    }

    public function showRegister() : void
    {
        $view = new View("Connexion");
        $view->render("register");
    }

    public function showAccount() : void
    {
        // Récupération de l'id de l'utilisateur local.
        $userId = $_SESSION['userId'];

        // On recupere les données de l'utilisateur.
        $userManager = new UserManager();
        $user = $userManager->getUserById($userId);

        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }
        // On recupere les données des livres de l'utilisateur cible.
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooksOfUserID($userId);

        // On vérifie l'utilisateur existe.
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        $view = new View("Mon compte");
        $view->render("account", [
            'user' => $user,
            'books' => $books,
        ]);
    }

    public function showUserProfil(): void
    {
        $userId = (int) Utils::request("user_id", -1);

        // On verifie que j'ai l'id de l'utilisateur connecté.
        if (Utils::isMe($userId)) {
            Utils::redirect("account");
            return;
        }

        // On recupere les données de l'utilisateur.
        $userManager = new UserManager();
        $user = $userManager->getUserById($userId);

        // On vérifie l'utilisateur existe.
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On recupere les données des livres de l'utilisateur cible.
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooksOfUserID($userId);

        $view = new View("Profil de " . $user->getPseudo());
        $view->render("userProfil", [
            'user' => $user,
            'books' => $books,
        ]);
    }

    public function addUser() : void
    {
        // Récupération des données du formulaire.
        $pseudo = htmlspecialchars(Utils::request("pseudo"));
        $email = htmlspecialchars(Utils::request("email"));
        $password = htmlspecialchars(Utils::request("password"));

        // On vérifie que les données sont valides.
        if (empty($pseudo) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 3");
        }

        // On crée l'objet user.
        $user = new User([
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        // On ajoute l'utilisateur.
        $userManager = new UserManager();
        $result = $userManager->addUser($user);
        $user->setId($result);

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['userId'] = $user->getId();

        // On redirige vers la page de l'utilisateur.
        Utils::redirect("account");
    }

    public function connectUser() : void 
    {
        // On récupère les données du formulaire.
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que les données sont valides.
        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            throw new Exception("Le mot de passe est incorrect");
        }

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['userId'] = $user->getId();

        // On redirige vers la page d'administration.
        Utils::redirect("account", ['userId' => $user->getId()]);
    }

    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function disconnectUser() : void 
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user']);
        unset($_SESSION['userId']);

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }
}