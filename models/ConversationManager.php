<?php

class ConversationManager extends AbstractEntityManager
{
    /**
     * Récupère une conversation par l'id d'un de ses utilisateurs.
     * @param int $myUserId : l'id de l'utilisateur.
     * @return ?array : un array de Conversation ou null si aucun conversation trouver.
     */
    public function getConversationsByUserId(int $myUserId) : ?array
    {
        $sql = "SELECT * FROM conversations WHERE user1_id = :myUserId OR user2_id = :myUserId
                ORDER BY date_creation DESC";
        $result = $this->db->query($sql, ['myUserId' => $myUserId]);
        $conversations = [];

        while ($conv = $result->fetch()) {
            $conversations[] = new Conversation($conv);
        }
        return $conversations;
    }

    /**
     * Récupère une conversation par son id.
     * @param int $id : l'id de la conversation.
     * @return Conversation|null : un objet Conversation ou null si la conversation n'existe pas.
     */
    public function getConversationsById(int $id) : ?Conversation
    {
        $sql = "SELECT * FROM conversations WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $conversation = $result->fetch();
        if ($conversation) {
            return new Conversation($conversation);
        }
        return null;
    }
    
    /**
     * Verifier que la conversation existe.
     * @param int $myUserId : mon id.
     * @param int $senderUserId : l'id de mon correspondant.
     * @return int
     */
    public function existConversation(int $myUserId, int $senderUserId) : int
    {
        $sql = "SELECT * FROM conversations WHERE user1_id = LEAST(:myUserId, :senderUserId) AND user2_id = GREATEST(:myUserId, :senderUserId);";
        $result = $this->db->query($sql, ['myUserId' => $myUserId, 'senderUserId' => $senderUserId]);
        $conv = $result->fetch();

        if ($conv) {
            $tmpConv = new Conversation($conv);
            return $tmpConv->getId();
        }
        return -1;
    }

    /**
     * Recupere les conversation ou l'utilisateur n'a pas lu au moins un message.
     * @param int $myUserId : mon id.
     * @return int
     */
    public function countUnreadConversations(int $myUserId) : int
    {
        $sql = "SELECT COUNT(*) as total FROM conversations
            WHERE 
                (user1_id = :userId AND unread_user1 = TRUE)
                OR
                (user2_id = :userId AND unread_user2 = TRUE)";

        $result = $this->db->query($sql, ['userId' => $myUserId])->fetch();

        return (int) $result['total'];
    }

    /**
     * Ajoute une conversation.
     * @param Conversation $conv : conversation à ajouter.
     * @return int
     */
    public function addConversation(Conversation $conv) : int
    {
        $sql = "INSERT INTO conversations (user1_id, user2_id, date_creation, date_update) VALUES (:user1_id, :user2_id, NOW(), NOW())";
        $this->db->query($sql, [
            'user1_id' => $conv->getUser1Id(),
            'user2_id' => $conv->getUser2Id(),
        ]);

        return $this->db->getPDO()->lastInsertId();
    }

    /**
     * Met à jour le dernier message.
     * @param Message $message
     * @return void
     */
    public function updateLastMessage(Message $message)
    {
        $sql = "UPDATE conversations SET last_message = :lastMessage, date_update = NOW(),
            unread_user1 = CASE 
                WHEN user1_id != :senderId THEN TRUE 
                ELSE unread_user1 
            END,
            unread_user2 = CASE 
                WHEN user2_id != :senderId THEN TRUE 
                ELSE unread_user2 
            END 
            WHERE id = :id";
        $this->db->query($sql, [
            'lastMessage' => $message->getContent(),
            'id' => $message->getConversationId(),
            'senderId' => $message->getSenderId(),
        ]);
    }

    /**
     * Met à jour la lecteur de message.
     * @param int $myUserId : utilisateur qui a lu.
     * @param int $conversationId : conversation à modifier.
     * @return void
     */
    public function iReadConversation(int $myUserId, int $conversationId)
    {
        $sql = "UPDATE conversations SET
            unread_user1 = CASE 
                WHEN user1_id = :readerId THEN FALSE 
                ELSE unread_user1 
            END,
            unread_user2 = CASE 
                WHEN user2_id = :readerId THEN FALSE 
                ELSE unread_user2 
            END 
            WHERE id = :conversationId";

        $this->db->query($sql, [
            'conversationId' => $conversationId,
            'readerId' => $myUserId
        ]);
    }

    /**
     * Supprime une conversation.
     * @param int $id : l'id de la conversation à supprimer.
     * @return void
     */
    public function deleteConversation(int $id) : void
    {
        $sql = "DELETE FROM conversations WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }
}