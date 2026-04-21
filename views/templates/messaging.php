<?php
    /**
     * Affichage la page de messagerie.
     */
?>

<div class="messaging">
    <div class="convs" id="convs">
        <h3>Messagerie</h3>
        <div class="sidebar" id="conversations">
            <!-- Liste des conversations -->
        </div>
    </div>

    <div class="chat" id="chat">
        <a href="" class="link resetLink" id="backConv"><img src="./resources/back.svg" alt="backpage"> retour</a>
        <div class="user" id="user">
            <!-- Utilisateur -->
        </div>

        <div class="messages" id="messages">
            <!-- Messages -->
        </div>

        <form id="sendMessageForm" class="sendForm">
            <input class="send" type="text" id="messageInput" placeholder="Écrire un message...">
            <button class="button green">Envoyer</button>
        </form>
    </div>
</div>