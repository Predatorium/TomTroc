<?php

class BooksController{
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
        $view = new View("Un livre");
        $view->render("detailBook");
    }
}