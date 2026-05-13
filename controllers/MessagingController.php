<?php

class MessagingController {

    /**
     * Affiche la messagerie.
     * @return void
     */
    public function showMessaging(): void
    {
        Utils::checkIfUserIsConnected();

        $conversationId = (int) Utils::request("conversation_id", -1);
        
        // On verifie l'ouverture de la page à une conversation specifique.
        if ($conversationId >= 0) {
            $convManager = new ConversationManager();
            // On recupere la conversation.
            $conv = $convManager->getConversationsById($conversationId);
            $userId = $_SESSION["userId"];
            
            // On verfifie que la conversation existe
            if (!$conv) {
                throw new Exception();
            }
            // On verifie mon implication dans la conversation.
            if ($conv->getUser1Id() != $userId && $conv->getUser2Id() != $userId) {
                throw new Exception();
            }
        }

        $view = new View("Messages");
        $view->render("messaging", ['selected' => 2]);
    }

    /**
     * Ajoute une conversation.
     * @return void
     */
    public function addConversation()
    {
        $userId = Utils::request("user_id");

        $convManager = new ConversationManager();
        // On verifie si il n'y a pas deja une conversation avec cet utilisateur.
        $convId = $convManager->existConversation((int) $_SESSION["userId"], $userId);

        // On creer la conversation si on en a pas trouvé.
        if ($convId < 0) {
            $convId = $convManager->addConversation(new Conversation([
                'user1ID' => $_SESSION["userId"] < $userId ? $_SESSION["userId"] : $userId,
                'user2ID' => $_SESSION["userId"] > $userId ? $_SESSION["userId"] : $userId,
            ]));
        }

        Utils::redirect("messaging", ['conversation_id' => $convId]);
    }

    /**
     * Envoie un message.
     * @return void
     */
    public function sendMessage()
    {
        // On recupere les infos du message.
        $conversationId = Utils::request("conversation_id", -1);
        $userId = $_SESSION['userId'] ?? -1;
        $content = htmlspecialchars(Utils::request("message", ""));

        // On verifie que les infos soit valide.
        if ($conversationId < 0 || $userId < 0 || empty($content)) {
            http_response_code(404);
            echo json_encode(["status" => "invalid"]);
            exit;
        }

        $message = new Message([
            'conversationId' => $conversationId,
            'senderId' => $userId,
            'content' => $content,
        ]);

        // On ajoute le message.
        $messageManager = new MessageManager();
        $messageManager->addMessage($message);

        // On met a jour le dernier message de la conversation.
        $convManager = new ConversationManager();
        $convManager->updateLastMessage($message);

        echo json_encode(["status" => "ok"]);
        exit;
    }

    /**
     * Recupere les infos d'une conversation pour le javascript.
     * @return void
     */
    public function getConversation(): void
    {
        $conversationId = (int) Utils::request("conversation_id");
        
        $convManager = new ConversationManager();
        $conv = $convManager->getConversationsById($conversationId);
        
        // On verifie que la conversation existe
        if (!$conv) {
            http_response_code(404);
            echo json_encode(['error' => 'Conversation introuvable']);
            exit;
        }

        // On recupere l'id de l'autre utilisateur.
        $otherUserId = Utils::isMe($conv->getUser1Id()) ? $conv->getUser2Id() : $conv->getUser1Id();
        $userManager = new UserManager();
        $otherUser = $userManager->getUserbyId($otherUserId);

        // On verifie que l'utilisateur existe.
        if (!$otherUser) {
            http_response_code(404);
            echo json_encode(['error' => 'Utilisateur introuvable']);
            exit;
        }

        // On prepare nos infos pour javascript.
        $result = [
            'id' => $conv->getId(),
            'picture' => $otherUser->getPicture(),
            'pseudo' => $otherUser->getPseudo(),
            'lastMessage' => $conv->getLastMessage(25),
            'lastMessageLength' => strlen($conv->getLastMessage()),
            'lastUpdate' => $conv->getDateUpdate()->format('H\hi'),
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Recupere les infos des conversations d'un utilisateur pour le javascript.
     * @return void
     */
    public function getConversations()
    {
        $userId = $_SESSION['userId'];
        $userManager = new UserManager();

        $manager = new ConversationManager();
        $convs = $manager->getConversationsByUserId($userId);

        $result = [];

        foreach ($convs as $conv) {
            
            // On recupere l'id de l'autre utilisateur.
            $otherUserId = Utils::isMe($conv->getUser1Id()) ? $conv->getUser2Id() : $conv->getUser1Id();
            $otherUser = $userManager->getUserbyId($otherUserId);
            
            // On verifie que l'utilisateur existe.
            if (!$otherUser) {
                http_response_code(404);
                echo json_encode(['error' => 'Utilisateur introuvable']);
                exit;
                }
                
            // On prepare nos infos pour javascript.
            $result[] = [
                'id' => $conv->getId(),
                'picture' => $otherUser->getPicture(),
                'pseudo' => $otherUser->getPseudo(),
                'lastMessage' => $conv->getLastMessage(25),
                'lastMessageLength' => strlen($conv->getLastMessage()),
                'lastUpdate' => $conv->getDateUpdate()->format('H\hi'),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Recupere les infos des messages d'une conversation pour le javascript.
     * @return void
     */
    public function getMessages()
    {
        $lastId = Utils::request("last_id");
        $conversationId = Utils::request("conversation_id");
        
        // On met a jour la valeur de lecture d'une conversation.
        $convManager = new ConversationManager();
        $convManager->iReadConversation($_SESSION['userId'], $conversationId);

        $userManager = new UserManager();

        // On verifie si il y a de nouveaux messages.
        $msgManager = new MessageManager();
        $messages = $msgManager->getNewMessages($conversationId, $lastId);

        $result = [];

        foreach ($messages as $msg) {

            // On verifie si on est l'auteur de ce messages
            $isMe = Utils::isMe($msg->getSenderId());
            $user = $userManager->getUserbyId($msg->getSenderId());

            // On prepare nos infos pour javascript.
            $result[] = [
                'id' => $msg->getId(),
                'picture' => $user->getPicture(),
                'pseudo' => $user->getPseudo(),
                'content' => $msg->getContent(),
                'date' => $msg->getDateCreation()->format('m.d H:i'),
                'isMe' => $isMe
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Verification du nombre de conversations non lues pour javascript.
     * @return void
     */
    public function getCountUnreadConversations()
    {
        $userId = $_SESSION['userId'];
        // On recupere le nombre de conversations non lues.
        $convManager = new ConversationManager();
        $countUnread = $convManager->countUnreadConversations($userId);

        // Envoie au javascript.
        header('Content-Type: application/json');
        echo json_encode($countUnread);
        exit;
    }
}