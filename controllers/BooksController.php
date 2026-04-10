<?php

class BooksController {
    /**
     * Affiche la page d'échange de livre.
     * @return void
     */

    public function showBooks() : void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();

        $userManager = new UserManager();

        $view = new View("Nos livres à l’échange");
        $view->render("exchangeBooks", [
            'books' => $books,
            'userManager' => $userManager,
        ]);
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
}