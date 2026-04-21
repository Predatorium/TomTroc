<?php

class MessagingController {

    public function showMessaging(): void
    {
        Utils::checkIfUserIsConnected();

        $view = new View("Messages");
        $view->render("messaging");
    }

    public function addConversation()
    {
        $userId = Utils::request("user_id");

        $convManager = new ConversationManager();
        
        if (!$convManager->existConversation((int) $_SESSION["userId"], $userId)) {

            $convManager->addConversation(new Conversation([
                'user1ID' => $_SESSION["userId"] < $userId ? $_SESSION["userId"] : $userId,
                'user2ID' => $_SESSION["userId"] > $userId ? $_SESSION["userId"] : $userId,
            ]));
        }

        Utils::redirect("messaging");
    }

    public function sendMessage()
    {
        Utils::checkIfUserIsConnected();
        $message = new Message([
            'conversationId' => Utils::request("conversation_id"),
            'senderId' => $_SESSION['userId'] ?? 0,
            'content' => htmlspecialchars(Utils::request("message")),
        ]);

        $messageManager = new MessageManager();
        $messageManager->addMessage($message);

        $convManager = new ConversationManager();
        $convManager->updateLastMessage($message);

        echo json_encode(["status" => "ok"]);
        exit;
    }

    public function getConversation(): void
    {
        Utils::checkIfUserIsConnected();

        $conversationId = (int) Utils::request("conversation_id");
        
        $convManager = new ConversationManager();
        $conv = $convManager->getConversationsById($conversationId);

        if (!$conv) {
            http_response_code(404);
            echo json_encode(['error' => 'Conversation introuvable']);
            exit;
        }
        
        $otherUserId = Utils::isMe($conv->getUser1Id()) ? $conv->getUser2Id() : $conv->getUser1Id();
        $userManager = new UserManager();
        $otherUser = $userManager->getUserbyId($otherUserId);

        if (!$otherUser) {
            http_response_code(404);
            echo json_encode(['error' => 'Utilisateur introuvable']);
            exit;
        }

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

    public function getConversations()
    {
        Utils::checkIfUserIsConnected();

        $userId = $_SESSION['userId'];
        $userManager = new UserManager();

        $manager = new ConversationManager();
        $convs = $manager->getConversationsByUserId($userId);

        $result = [];

        foreach ($convs as $conv) {

            $otherUserId = Utils::isMe($conv->getUser1Id()) ? $conv->getUser2Id() : $conv->getUser1Id();
            $otherUser = $userManager->getUserbyId($otherUserId);

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

    public function getMessages()
    {
        Utils::checkIfUserIsConnected();

        $lastId = Utils::request("last_id");
        $conversationId = Utils::request("conversation_id");
        $userManager = new UserManager();

        $msgManager = new MessageManager();
        $messages = $msgManager->getNewMessages($conversationId, $lastId);

        $result = [];

        foreach ($messages as $msg) {

            $isMe = Utils::isMe($msg->getSenderId());
            $user = $userManager->getUserbyId($msg->getSenderId());

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
}