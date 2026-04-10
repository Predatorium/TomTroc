<?php

/**
 * Entité User : un user est défini par son id, un login et un password.
 */ 
class Book extends AbstractEntity 
{
    private int $userId;
    private string $title = "";
    private string $autor = "";
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
     * @param string $autor
     */
    public function setAutor(string $autor) : void 
    {
        $this->autor = $autor;
    }

    /**
     * Getter pour l'auteur.
     * @return string
     */
    public function getAutor() : string 
    {
        return $this->autor;
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
     * @param string $available
     */
    public function setAvailable(bool $available) : void 
    {
        $this->available = $available;
    }

    /**
     * Getter pour la disponibilité.
     * @return string
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