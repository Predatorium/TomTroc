<?php

class ConversationManager extends AbstractEntityManager
{
    /**
     * Récupère une conversation par son id.
     * @param int $id : l'id de la conversation.
     * @return Conversation|null : un objet Conversation ou null si la conversation n'existe pas.
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
    public function getConversationsById(string $id) : ?Conversation
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
     * @return void
     */
    public function existConversation(int $myUserId, int $senderUserId) : bool
    {
        $sql = "SELECT * FROM conversations WHERE user1_id = LEAST(:myUserId, :senderUserId) AND user2_id = GREATEST(:myUserId, :senderUserId);";
        $result = $this->db->query($sql, ['myUserId' => $myUserId, 'senderUserId' => $senderUserId]);
        $conv = $result->fetch();

        if ($conv) {
            return true;
        }
        return false;
    }

    /**
     * Ajoute une conversation.
     * @param Conversation $conv : conversation à ajouter.
     * @return void
     */
    public function addConversation(Conversation $conv) : void
    {
        $sql = "INSERT INTO conversations (user1_id, user2_id, date_creation, date_update) VALUES (:user1_id, :user2_id, NOW(), NOW())";
        $this->db->query($sql, [
            'user1_id' => $conv->getUser1Id(),
            'user2_id' => $conv->getUser2Id(),
        ]);
    }

    /**
     * Met à jour le dernier message.
     * @param string $lastMessage : livre à modifier.
     * @return void
     */
    public function updateLastMessage(Message $message)
    {
        $sql = "UPDATE conversations SET last_message = :lastMessage, date_update = NOW() WHERE id = :id";
        $this->db->query($sql, [
            'lastMessage' => $message->getContent(),
            'id' => $message->getConversationId(),
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