<?php

class AccountController {
    
    /**
     * Affiche la page de connexion.
     * @return void
     */
    public function showLogin() : void
    {
        $view = new View("Connexion");
        $view->render("login", ['selected' => 3]);
    }

    /**
     * Affiche la page d'inscription.
     * @return void
     */
    public function showRegister() : void
    {
        $view = new View("Inscription");
        $view->render("register", ['selected' => 2]);
    }

    /**
     * Affiche la page mon compte.
     * @return void
     */
    public function showAccount() : void
    {
        Utils::checkIfUserIsConnected();

        // Récupération de l'id de l'utilisateur local.
        $userId = $_SESSION['userId'];

        // On recupere les données de l'utilisateur.
        $userManager = new UserManager();
        $user = $userManager->getUserById($userId);
        
        // On vérifie que l'utilisateur existe.
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }
        // On recupere les données des livres de l'utilisateur cible.
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooksOfUserID($userId);

        $view = new View("Mon compte");
        $view->render("account", [
            'user' => $user,
            'books' => $books,
            'selected' => 3
        ]);
    }

    /**
     * Affiche la page de profil.
     * @return void
     */
    public function showUserProfil(): void
    {
        $userId = (int) Utils::request("user_id", -1);

        // On verifie que c'est mon id d'utilisateur.
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
            'selected' => -1,
        ]);
    }

    /**
     * Ajoute un utilisateur.
     * @return void
     */
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
        $user = $userManager->getUserById($result);

        // On connecte l'utilisateur.
        $_SESSION['user'] = $user;
        $_SESSION['userId'] = $user->getId();

        // On redirige vers la page de l'utilisateur.
        Utils::redirect("account");
    }

    /**
     * retourne en json la valider de la connexion à un compte pour le javascript.
     * @return void
     */
    public function getValidConnect(): void
    {
        // On récupère les données du formulaire.
        $email = Utils::request("email");
        $password = Utils::request("password");

        // On vérifie que l'utilisateur existe.
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);
        if (!$user) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 0]);
            exit;
        }

        // On vérifie que le mot de passe est correct.
        if (!password_verify($password, $user->getPassword())) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 0]);
            exit;
        }

        header('Content-Type: application/json');
        echo json_encode(['error' => 1]);
        exit;
    }

    /**
     * Connexion.
     * @return void
     */
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

        // On redirige vers la mon compte.
        Utils::redirect("account");
    }

    /**
     * Mise a jour des infos d'un utilisateur.
     * @return void
     */
    public function updateUser(): void
    {
        // Récupération des données du formulaire.
        $pseudo = htmlspecialchars(Utils::request("pseudo", ""));
        $email = htmlspecialchars(Utils::request("email", ""));
        $password = htmlspecialchars(Utils::request("password", ""));
        var_dump($pseudo);
        var_dump($email);
        var_dump($password);

        $userManager = new UserManager();
        $user = $userManager->getUserById($_SESSION['userId']);
        if (!empty($pseudo) && $pseudo != $user->getPseudo()) {
            $user->setPseudo($pseudo);
        }
        if (!empty($email) && $email != $user->getEmail()) {
            $user->setEmail($email);
        }
        if (!empty($password) && !password_verify($password, $user->getPassword())) {
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        }

        $userManager->updateAccount($user);

        // On redirige vers la mon compte.
        Utils::redirect("account");
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