<?php

class MessageManager extends AbstractEntityManager
{
    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getMessagesByConversationId(int $conversationId) : ?array
    {
        $sql = "SELECT * FROM messages WHERE conversation_id = :conversationId ORDER BY date_creation DESC";
        $result = $this->db->query($sql, ['conversationId' => $conversationId]);
        $messages = [];

        while ($message = $result->fetch()) {
            $messages[] = new Message($message);
        }
        return $messages;
    }

    public function getNewMessages(int $conversationId, int $lastId) : array
    {
        $sql = "SELECT * FROM messages 
                WHERE conversation_id = :conversationId 
                AND id > :lastId
                ORDER BY id ASC";

        $result = $this->db->query($sql, [
            'conversationId' => $conversationId,
            'lastId' => $lastId
        ]);

        $messages = [];

        while ($message = $result->fetch()) {
            $messages[] = new Message($message);
        }

        return $messages;
    }

    /**
     * Envoyer un message.
     * @param Message $message : message à ajouter.
     * @return void
     */
    public function addMessage(Message $message) : void
    {
        $sql = "INSERT INTO messages (conversation_id, sender_id, content, date_creation) VALUES (:conversation_id, :sender_id, :content, NOW())";
        $this->db->query($sql, [
            'conversation_id' => $message->getConversationId(),
            'sender_id' => $message->getSenderId(),
            'content' => $message->getContent(),
        ]);
    }

    /**
     * Supprime tout les messages d'une conversation.
     * @param int $id : l'id de la conversation à supprimer.
     * @return void
     */
    public function deleteMessages(int $conversationId) : void
    {
        $sql = "DELETE FROM messages WHERE conversation_id = :conversation_id";
        $this->db->query($sql, ['conversation_id' => $conversationId]);
    }
}