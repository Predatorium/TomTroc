<?php

/**
 * Entité User : un user est défini par son id, un login et un password.
 */ 
class Conversation extends AbstractEntity 
{
    private int $user1ID;
    private int $user2ID;
    private string $lastMessage;
    private ?DateTime $dateCreation = null;
    private ?DateTime $dateUpdate = null;
    private bool $unreadUser1 = true;
    private bool $unreadUser2 = true;

    /**
     * Setter pour l'id de l'utilisateur 1. 
     * @param int $user1ID
     */
    public function setUser1Id(int $user1ID) : void
    {
        $this->user1ID = $user1ID;
    }

    /**
     * Getter pour l'id de l'utilisateur 1.
     * @return int
     */
    public function getUser1Id() : int
    {
        return $this->user1ID;
    }

    /**
     * Setter pour l'id de l'utilisateur 2. 
     * @param int $user2ID
     */
    public function setUser2Id(int $user2ID) : void
    {
        $this->user2ID = $user2ID;
    }

    /**
     * Getter pour l'id de l'utilisateur 2.
     * @return int
     */
    public function getUser2Id() : int
    {
        return $this->user2ID;
    }

    /**
     * Setter pour le dernier message de la conversation.
     * @param string $lastMessage
     */
    public function setLastMessage(string $lastMessage) : void
    {
        $this->lastMessage = $lastMessage;
    }
    
    /**
     * Getter pour le dernier message de la conversation.
     * Retourne les $length premiers caractères du dernier message de la conversation.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le message.
     * Si le message est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getLastMessage(int $length = -1) : string
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $lastMessage = mb_substr($this->lastMessage, 0, $length);
            if (strlen($this->lastMessage) > $length) {
                $lastMessage .= "...";
            }
            return $lastMessage ?? "";
        }
        return $this->lastMessage ?? "";
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

    /**
     * Setter pour la date de mise à jour. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateUpdate
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setDateUpdate(string|DateTime $dateUpdate, string $format = 'Y-m-d H:i:s') : void
    {
        if (is_string($dateUpdate)) {
            $dateUpdate = DateTime::createFromFormat($format, $dateUpdate);
        }
        $this->dateUpdate = $dateUpdate;
    }

    /**
     * Getter pour la date de mise à jour.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime.
     * @return DateTime
     */
    public function getDateUpdate() : DateTime
    {
        return $this->dateUpdate;
    }

    /**
     * Setter pour la non lecteur du premier utilisateur.
     * @return void
     */
    public function setUnreadUser1(bool $unread): void
    {
        $this->unreadUser1 = $unread;
    }

    /**
     * Getter pour la non lecteur du premier utilisateur.
     * @return bool
     */
    public function getUnreadUser1(): bool
    {
        return $this->unreadUser1;
    }

    /**
     * Setter pour la non lecteur du deuxieme utilisateur.
     * @return void
     */
    public function setUnreadUser2(bool $unread): void
    {
        $this->unreadUser2 = $unread;
    }

    /**
     * Getter pour la non lecteur du deuxieme utilisateur.
     * @return bool
     */
    public function getUnreadUser2(): bool
    {
        return $this->unreadUser2;
    }
}