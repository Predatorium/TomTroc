<?php

class MessagingController {

    public function showMessaging(): void
    {
        Utils::checkIfUserIsConnected();

        $conversationId = (int) Utils::request("conversation_id", -1);
        
        if ($conversationId >= 0) {
            $convManager = new ConversationManager();
            $conv = $convManager->getConversationsById($conversationId);
            $userId = $_SESSION["userId"];

            if (!$conv) {
                throw new Exception();
            }
            if ($conv->getUser1Id() != $userId && $conv->getUser2Id() != $userId) {
                throw new Exception();
            }
        }

        $view = new View("Messages");
        $view->render("messaging");
    }

    public function addConversation()
    {
        $userId = Utils::request("user_id");

        $convManager = new ConversationManager();
        $convId = $convManager->existConversation((int) $_SESSION["userId"], $userId);

        if ($convId < 0) {

            $convId = $convManager->addConversation(new Conversation([
                'user1ID' => $_SESSION["userId"] < $userId ? $_SESSION["userId"] : $userId,
                'user2ID' => $_SESSION["userId"] > $userId ? $_SESSION["userId"] : $userId,
            ]));
        }

        Utils::redirect("messaging", ['conversation_id' => $convId]);
    }

    public function sendMessage()
    {
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
        $conversationId = (int) Utils::request("conversation_id");
        
        $convManager = new ConversationManager();
        $conv = $convManager->getConversationsById($conversationId);
        
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
        $lastId = Utils::request("last_id");
        $conversationId = Utils::request("conversation_id");
        $convManager = new ConversationManager();
        $convManager->iReadConversation($_SESSION['userId'], $conversationId);
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

    public function getCountUnreadConversations()
    {
        $userId = $_SESSION['userId'];
        $convManager = new ConversationManager();
        $countUnread = $convManager->countUnreadConversations($userId);

        header('Content-Type: application/json');
        echo json_encode($countUnread);
        exit;
    }
}