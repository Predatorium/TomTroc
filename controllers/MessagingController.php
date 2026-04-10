<?php

class MessagingController {

    public function showMessaging(): void
    {
        // Récupération de l'id de l'utilisateur local.
        $userId = $_SESSION['user'];

        $convManager = new ConversationManager();
        $convs = $convManager->getConversationsByUserId($userId);

        $messageManager = new MessageManager();
        $messages = $messageManager->getMessagesByConversationId($convs->getId());

        $view = new View("Messages");
        $view->render("messaging", [
            'convs' => $convs,
            'messages' => $messages,
        ]);
    }

    public function sendMessage(): void
    {
        
    }
}