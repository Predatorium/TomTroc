<?php

/**
 * Entité Book : un book est défini par son id, par son userId, par son title, par un author, par une description, par une picture et par un available.
 */ 
class Book extends AbstractEntity 
{
    private int $userId;
    private string $title = "";
    private string $author = "";
    private string $description = "";
    private string $picture = "";
    private bool $available = true;

    /**
     * Setter pour l'id de l'utilisateur. 
     * @param int $userId
     */
    public function setUserId(int $userId) : void 
    {
        $this->userId = $userId;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int
     */
    public function getUserID() : int 
    {
        return $this->userId;
    }

    /**
     * Setter pour le titre.
     * @param string $title
     */
    public function setTitle(string $title) : void 
    {
        $this->title = $title;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public function getTitle() : string 
    {
        return $this->title;
    }

    /**
     * Setter pour l'auteur.
     * @param string $author
     */
    public function setAuthor(string $author) : void 
    {
        $this->author = $author;
    }

    /**
     * Getter pour l'auteur.
     * @return string
     */
    public function getAuthor() : string 
    {
        return $this->author;
    }

    /**
     * Setter pour la description.
     * @param string $description
     */
    public function setDescription(string $description) : void 
    {
        $this->description = $description;
    }

    
    /**
     * Getter pour la description.
     * Retourne les $length premiers caractères de la description.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne toute la description.
     * Si la description est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getDescription(int $length = -1) : string 
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $description = mb_substr($this->description, 0, $length);
            if (strlen($this->description) > $length) {
                $description .= "...";
            }
            return $description;
        }
        return $this->description;
    }

    /**
     * Setter pour l'image.
     * @param string $picture
     */
    public function setPicture(string $picture) : void 
    {
        $this->picture = $picture;
    }

    /**
     * Getter pour l'image.
     * @return string
     */
    public function getPicture() : string 
    {
        return $this->picture;
    }

    /**
     * Setter pour la disponibilité.
     * @param bool $available
     */
    public function setAvailable(bool $available) : void 
    {
        $this->available = $available;
    }

    /**
     * Getter pour la disponibilité.
     * @return bool
     */
    public function getAvailable() : bool 
    {
        return $this->available;
    }

    /**
     * Getter pour la disponibilité.
     * @return string
     */
    public function getAvailableToString() : string 
    {
        return $this->available ? "disponible" : "non dispo.";
    }
}