<?php

/**
 * Entité User : un user est défini par son id, un pseudo, un email, un password et une picture.
 */ 
class User extends AbstractEntity 
{
    private string $pseudo;
    private string $email;
    private string $password;
    private string $picture = "";
    private ?DateTime $dateCreation = null;

    /**
     * Setter pour le pseudo.
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo) : void 
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Getter pour le pseudo.
     * @return string
     */
    public function getPseudo() : string 
    {
        return $this->pseudo;
    }

    /**
     * Setter pour l'email'.
     * @param string $email
     */
    public function setEmail(string $email) : void 
    {
        $this->email = $email;
    }

    /**
     * Getter pour l'email.
     * @return string
     */
    public function getEmail() : string 
    {
        return $this->email;
    }

    /**
     * Setter pour le password.
     * @param string $password
     */
    public function setPassword(string $password) : void 
    {
        $this->password = $password;
    }

    /**
     * Getter pour le password.
     * @return string
     */
    public function getPassword() : string 
    {
        return $this->password;
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
     * Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateCreation
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setDateCreation(string|DateTime $dateCreation, string $format = 'Y-m-d H:i:s') : void
    {
        if (is_string($dateCreation)) {
            $dateCreation = DateTime::createFromFormat($format, $dateCreation);
        }
        $this->dateCreation = $dateCreation;
    }

    /**
     * Getter pour la date de création.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime.
     * @return DateTime
     */
    public function getDateCreation() : DateTime
    {
        return $this->dateCreation;
    }
}