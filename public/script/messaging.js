/**
 * Script en lien avec la messagerie.
 */

let activeConversationId = null;
let lastMessageId = -1;
let convIntervalId = 0;
let msgIntervalId = 0;

// Sert à charger les conversations dans les quels l'utilisateur local est impliqué.
function loadConversations() {
    fetch("index.php?action=getConversations")
        .then(res => res.json())
        .then(data => {
            let html = "";

            data.forEach(conv => {
                html += `
                    <div onclick="selectConversation(${conv.id})" class="conv" id="conv${conv.id}">
                        <img src="${conv.picture}" alt="convPicture" class="picture">
                        <div class="info">
                            <div class="upper">
                                <p>${conv.pseudo}</p>
                                <p>${conv.lastUpdate}</p>
                            </div>
                            <p>${conv.lastMessageLength < 1 ? "..." : conv.lastMessage}</p>
                        </div>
                    </div>
                `;
            });
            document.getElementById("conversations").innerHTML = html;
            
            // Si on n'est pas sur mobile sélectionner une conversation par default.
            if (!isMobile && activeConversationId == null && data.length > 0) {
                const conversationId = params.get("conversation_id") ?? data[0].id;
                selectConversation(conversationId);
            }
        });
}

// Sert à selectionner une conversation pour accéder aux messages de cette dernières.
function selectConversation(id) {
    let activeconv;

    // Si une conversation est deja active on reset les infos utilisateur de la partie messages
    if (activeConversationId  != null){
        activeconv = document.getElementById("conv" + activeConversationId)
        activeconv.classList.remove("selected")
        document.getElementById("user").innerHTML = "";
    }

    activeConversationId = id;

    activeconv = document.getElementById("conv" + id)
    activeconv.classList.add("selected")

    // Info utilisateur avec lequel on echange pour la partie messages.
    fetch(`index.php?action=getConversation&conversation_id=${activeConversationId}`)
        .then(res => res.json())
        .then(data => {
            document.getElementById("user").innerHTML = `
                <img src="${data.picture}" alt="picture" class="picture">
                <p class="pseudo">${data.pseudo}</p>
            `;
        })

    // reset messages
    lastMessageId = -1;
    document.getElementById("messages").innerHTML = "";

    loadMessages();
    msgIntervalId = setInterval(loadMessages, 2000)

    // Si on est sur mobile deafficher les conversation et afficher les messages.
    if (isMobile) {
        clearInterval(convIntervalId);
        document.getElementById("convs").classList.remove("active");
        document.getElementById("chat").classList.add("active");
    }
}

// Sert à charger les messages de la conversation active.
function loadMessages() {
    if (!activeConversationId) return;

    fetch(`index.php?action=getMessages&conversation_id=${activeConversationId}&last_id=${lastMessageId}`)
        .then(res => res.json())
        .then(data => {
            let html = "";
            let firstLoad = lastMessageId < 0;
            
            data.forEach(msg => {
                if (msg.isMe) {
                    html += `
                        <div class="msg me">
                            <p class="date">${msg.date}</p>
                            <p class="content">${msg.content}</p>
                        </div>
                    `;
                }
                else {
                    html += `
                        <div class="msg other">
                            <div class="upper">
                                <img src="${msg.picture}" alt="userPicture" class="userPicture">
                                <p class="date">${msg.date}</p>
                            </div>
                            <p class="content">${msg.content}</p>
                        </div>
                    `;
                }
                lastMessageId = msg.id;
            });
            document.getElementById("messages").innerHTML += html;

            // Si c'est notre premier chargement de la conversation on scroll jusqu'au dernier message.
            if (firstLoad) {
                document.getElementById("messages").scrollTop = messages.scrollHeight;
            }
        });
}



// envoyer message
const sendBalise = document.getElementById("sendMessageForm");
if (sendBalise != null) {
    sendBalise.addEventListener("submit", e => {
        e.preventDefault();
    
        if (!activeConversationId) return;
    
        let message = document.getElementById("messageInput").value;
    
        fetch("index.php?action=sendMessage", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: 
                "message=" + encodeURIComponent(message) +
                "&conversation_id=" + activeConversationId
        });
    
        document.getElementById("messageInput").value = "";
    });
}

// Sert à revenir à la liste des conversation sur mobile.
const backConvBalise = document.getElementById("backConv");
if (backConvBalise != null) {
    document.getElementById("backConv").addEventListener("click", e =>{
        e.preventDefault();
    
        activeConversationId = null;
        loadConversations();
        convIntervalId = setInterval(loadConversations, 2000)
    
        clearInterval(msgIntervalId);
        document.getElementById("chat").classList.remove("active");
        document.getElementById("convs").classList.add("active");
    
        lastMessageId = -1;
    });
}