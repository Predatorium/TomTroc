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
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($bookId);

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
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($bookId);
        
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
        $autor = htmlspecialchars(Utils::request("autor"));
        $comment = htmlspecialchars(Utils::request("comment"));
        $available = (int) Utils::request("available");

        // On vérifie que les données sont valides.
        if (empty($title) || empty($autor) || empty($comment)) {
            throw new Exception("Tous les champs sont obligatoires. 3");
        }

        $newBook = new Book([
            'user_id' => $userId,
            'title' => $title,
            'autor' => $autor,
            'description' => $comment,
            'picture' => "",
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

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($bookId);

        if (!Utils::isMe($book->getUserID())) {
            Utils::redirect("account");
            exit;
        }

        // Récupération des données du formulaire.
        $title = htmlspecialchars(Utils::request("title", $book->getTitle()));
        $autor = htmlspecialchars(Utils::request("autor", $book->getAutor()));
        $comment = htmlspecialchars(Utils::request("comment", $book->getDescription()));
        $available = (int) Utils::request("available", $book->getAvailable());

        // On vérifie que les données sont valides.
        if (empty($title) || empty($autor) || empty($comment)) {
            throw new Exception("Tous les champs sont obligatoires. 3");
        }

        $newBook = new Book([
            'title' => $title,
            'autor' => $autor,
            'description' => $comment,
            'picture' => $book->getPicture(),
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

        // On supprime le livre.
        $bookManager = new BookManager();
        $bookManager->deleteBook($bookId);
       
        // On redirige vers la page du compte.
        Utils::redirect("account");
    }

    public function getBooks(): void
    {
        Utils::checkIfUserIsConnected();

        $research = Utils::request("research");
        
        $bookManager = new BookManager();
        $books = empty($research) ? $bookManager->getAllBooksAvailable() : $bookManager->getAllBooksSearch($research) ;
        $userManager = new UserManager();

        $result = [];

        foreach ($books as $book) {

            $result[] = [
                'id' => $book->getId(),
                'picture' => $book->getPicture(),
                'title' => $book->getTitle(),
                'autor' => $book->getAutor(),
                'seller' => $userManager->getUserById($book->getUserId())->getPseudo(),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}