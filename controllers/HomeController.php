<?php

class HomeController {

    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $bookManager = new BookManager();
        // On recupere les 4 derniers livres ajouté.
        $books = $bookManager->getLastFourBooks();

        $userManager = new UserManager();

        $view = new View("Accueil");
        $view->render("home", [
            'books' => $books,
            'userManager' => $userManager,
        ]);
    }
}