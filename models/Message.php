<?php

/**
 * Entité User : un user est défini par son id, un login et un password.
 */ 
class Message extends AbstractEntity 
{
    private int $conversationId;
    private int $senderId;
    private string $content;
    private ?DateTime $dateCreation = null;

    /**
     * Setter pour l'id de la conversation. 
     * @param int $conversationId
     */
    public function setConversationId(int $conversationId) : void
    {
        $this->conversationId = $conversationId;
    }

    /**
     * Getter pour l'id de la conversation.
     * @return int
     */
    public function getConversationId() : int
    {
        return $this->conversationId;
    }

    /**
     * Setter pour l'id de l'utilisateur qui as envoyé le message. 
     * @param int $senderId
     */
    public function setSenderId(int $senderId) : void
    {
        $this->senderId = $senderId;
    }

    /**
     * Getter pour l'id de l'utilisateur qui as envoyé le message.
     * @return int
     */
    public function getSenderId() : int
    {
        return $this->senderId;
    }

    /**
     * Setter pour le message.
     * @param string $content
     */
    public function setContent(string $content) : void
    {
        $this->content = $content;
    }
    
    /**
     * Getter pour le message.
     * Retourne les $length premiers caractères du message.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le message.
     * Si le message est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getContent(int $length = -1) : string
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $content = mb_substr($this->content, 0, $length);
            if (strlen($this->content) > $length) {
                $content .= "...";
            }
            return $content;
        }
        return $this->content;
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