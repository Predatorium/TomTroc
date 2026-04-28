<?php

class BooksController {
    /**
     * Affiche la page d'échange de livre.
     * @return void
     */

    public function showBooks() : void
    {
        $view = new View("Nos livres à l’échange");
        $view->render("exchangeBooks");
    }

    /**
     * Affiche la page d'échange de livre.
     * @return void
     */

    public function showDetailBook() : void
    {
        $bookId = Utils::request('book_id', -1);

        // On recupere les données du livre demandé.
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($bookId);

        // On vérifie que les données sont valides.
        if (!$book) {
            throw new Exception();
        }

        $userManager = new UserManager();
        
        $view = new View($book->getTitle());
        $view->render("detailBook", [
            'book' => $book,
            'userManager' => $userManager,
        ]);
    }

    public function showEditBook(): void
    {
        $bookId = Utils::request('book_id', -1);

        // On recupere les données du livre demandé.
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($bookId);
        
        // On vérifie que les données sont valides.
        if (!$book) {
            throw new Exception();
        }

        //On verifie que je suis le proprietaire du livre.
        if (!Utils::isMe($book->getUserID())) {
            throw new Exception();
        }

        $view = new View($book->getTitle());
        $view->render("editBook", ['book' => $book]);
    }

    public function showNewBook(): void
    {        
        $view = new View("Nouveau Livre");
        $view->render("newBook");
    }

    public function addBook(): void
    {
        Utils::checkIfUserIsConnected();

        $userId = $_SESSION["userId"];

        // Récupération des données du formulaire.
        $title = htmlspecialchars(Utils::request("title"));
        $author = htmlspecialchars(Utils::request("author"));
        $picture = htmlspecialchars(Utils::request("picture"));
        $comment = htmlspecialchars(Utils::request("comment"));
        $available = (bool) Utils::request("available", 1);

        // On vérifie que les données sont valides.
        if (empty($title) || empty($author) || empty($picture)) {
            throw new Exception("Tous les champs sont obligatoires. 3");
        }

        $newBook = new Book([
            'user_id' => $userId,
            'title' => $title,
            'author' => $author,
            'description' => $comment,
            'picture' => $picture,
            'available' => $available,
        ]);

        // On ajoute le livre.
        $bookManager = new BookManager();
        $bookManager->addOrUpdateBook($newBook);

        // On redirige vers la page du compte.
        Utils::redirect("account");

    }

    public function updateBook(): void
    {
        Utils::checkIfUserIsConnected();
        $bookId = Utils::request("book_id", -1);

        // On recupere les données du livre demandé.
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($bookId);

        // On vérifie que les données sont valides.
        if (!$book) {
            throw new Exception();
        }

        //On verifie que je suis le proprietaire du livre.
        if (!Utils::isMe($book->getUserID())) {
            throw new Exception();
        }

        // Récupération des données du formulaire.
        $title = htmlspecialchars(Utils::request("title", $book->getTitle()));
        $author = htmlspecialchars(Utils::request("author", $book->getAuthor()));
        $picture = htmlspecialchars(Utils::request("picture", $book->getPicture()));
        $comment = htmlspecialchars(Utils::request("comment", $book->getDescription()));
        $available = (int) Utils::request("available", $book->getAvailable());

        // On vérifie que les données sont valides.
        if (empty($title) || empty($author) || empty($picture)) {
            throw new Exception("Tous les champs sont obligatoires. 3");
        }

        $newBook = new Book([
            'title' => $title,
            'author' => $author,
            'description' => $comment,
            'picture' => $picture,
            'available' => $available,
            'id' => $bookId,
        ]);


        // On met à jour le livre.
        $bookManager->addOrUpdateBook($newBook);
       
        // On redirige vers la page du compte.
        Utils::redirect("account");
    }

    public function deleteBook(): void
    {
        Utils::checkIfUserIsConnected();

        $bookId = Utils::request("book_id", -1);

        // On recupere les données du livre demandé.
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($bookId);

        // On vérifie que les données sont valides.
        if (!$book) {
            throw new Exception();
        }

        //On verifie que je suis le proprietaire du livre.
        if (!Utils::isMe($book->getUserID())) {
            throw new Exception();
        }

        // On supprime le livre.
        $bookManager = new BookManager();
        $bookManager->deleteBook($bookId);
       
        // On redirige vers la page du compte.
        Utils::redirect("account");
    }

    public function getBooks(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $research = Utils::request("research", "");
        
        $bookManager = new BookManager();
        $books = [];
        $books = $bookManager->getAllBooksSearch($research);
        $userManager = new UserManager();

        $result = [];

        foreach ($books as $book) {

            $result[] = [
                'id' => $book->getId(),
                'picture' => $book->getPicture(),
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'seller' => $userManager->getUserById($book->getUserId())->getPseudo(),
            ];
        }

        echo json_encode($result);
        exit;
    }
}