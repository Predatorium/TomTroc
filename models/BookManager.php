<?php

/**
 * Classe qui gère les articles.
 */
class BookManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les livres.
     * @return array : un tableau d'objets Book.
     */
    public function getAllBooks() : array
    {
        $sql = "SELECT * FROM books ORDER BY id DESC";
        $result = $this->db->query($sql);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère tous les livres disponible.
     * @return array : un tableau d'objets Book.
     */
    public function getAllBooksAvailable() : array
    {
        $sql = "SELECT * FROM books WHERE available = :available ORDER BY id DESC";
        $result = $this->db->query($sql, ['available' => 1]);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère tous les livres d'un utilisateur.
     * @return array : un tableau d'objets Book.
     */
    public function getAllBooksOfUserID(int $user_id) : array
    {
        $sql = "SELECT * FROM books WHERE user_id = :user_id";
        $result = $this->db->query($sql, ['user_id' => $user_id]);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère tous les livres rechercher.
     * @return array : un tableau d'objets Book.
     */
    public function getAllBooksSearch(string $search) : array
    {
        $sql = "SELECT * FROM books WHERE (title LIKE :search_like OR author LIKE :search_like) AND available = :available ORDER BY id DESC";
        $result = $this->db->query($sql, ['search_like' => '%' . $search . '%', 'available' => 1]);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère les 4 derniers livres.
     * @return array : un tableau d'objets Book.
     */
    public function getLastFourBooks() : array
    {
        $sql = "SELECT * FROM books ORDER BY id DESC LIMIT 4";
        $result = $this->db->query($sql);
        $books = [];

        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Book ou null si l'article n'existe pas.
     */
    public function getBookById(int $id) : ?Book
    {
        $sql = "SELECT * FROM books WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $book = $result->fetch();
        if ($book) {
            return new Book($book);
        }
        return null;
    }

    /**
     * Ajoute ou modifie un livre.
     * On sait si livre est un nouveau livre car son id sera -1.
     * @param Book $book : livre à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateBook(Book $book) : void 
    {
        if ($book->getId() == -1) {
            $this->addBook($book);
        } else {
            $this->updateBook($book);
        }
    }

    /**
     * Ajoute un livre.
     * @param Book $book : livre à ajouter.
     * @return void
     */
    public function addBook(Book $book) : void
    {
        $sql = "INSERT INTO books (user_id, title, author, description, picture, available) VALUES (:user_id, :title, :author, :description, :picture, :available)";
        $this->db->query($sql, [
            'user_id' => $book->getUserId(),
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'picture' => $book->getPicture(),
            'available' => $book->getAvailable()
        ]);
    }

    /**
     * Modifie un livre.
     * @param Book $book : livre à modifier.
     * @return void
     */
    public function updateBook(Book $book) : void
    {
        $sql = "UPDATE books SET title = :title, author = :author, description = :description, picture = :picture, available = :available WHERE id = :id";
        $this->db->query($sql, [
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'picture' => $book->getPicture(),
            'available' => $book->getAvailable(),
            'id' => $book->getId()
        ]);
    }

    /**
     * Supprime un livre.
     * @param int $id : l'id du livre à supprimer.
     * @return void
     */
    public function deleteBook(int $id) : void
    {
        $sql = "DELETE FROM books WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }
}