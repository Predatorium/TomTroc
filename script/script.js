const isMobile = window.matchMedia("(max-width: 768px)").matches;

const toggle = document.getElementById("menu-toggle");
const menu = document.getElementById("nav-menu");

toggle.addEventListener("click", () => {
    menu.classList.toggle("active");
});

document.addEventListener('DOMContentLoaded', () => {
    if (document.body.dataset.page === 'Messages') {
        loadConversations();
        convIntervalId = setInterval(loadConversations, 2000)

        if (isMobile) {
            document.getElementById("convs").classList.add("active");
        }
    }

    if (document.getElementById("books") != null) {
        loadBooks("")
    }
});

let activeConversationId = null;
let lastMessageId = -1;
let convIntervalId = 0;
let msgIntervalId = 0;

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
            
            if (!isMobile && activeConversationId == null && data.length > 0) {
                selectConversation(data[0].id);
            }
        });
}

function selectConversation(id) {
    let activeconv;

    if (activeConversationId  != null){
        activeconv = document.getElementById("conv" + activeConversationId)
        activeconv.classList.remove("selected")
        document.getElementById("user").innerHTML = "";
    }

    activeConversationId = id;

    activeconv = document.getElementById("conv" + id)
    activeconv.classList.add("selected")

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

    if (isMobile) {
        clearInterval(convIntervalId);
        document.getElementById("convs").classList.remove("active");
        document.getElementById("chat").classList.add("active");
    }
}

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

const searchInputBalise = document.getElementById("searchInput");
if (searchInputBalise != null) {
    document.getElementById("searchInput").addEventListener("change", e =>{
        loadBooks(document.getElementById("searchInput").value);
    });
}

function loadBooks(research) {
    fetch(`index.php?action=getBooks&research=${research}`)
        .then(res => res.json())
        .then(data => {
            let html = "";

            data.forEach(book => {
                html += `
                    <div class="book">
                        <a href="index.php?action=detailBook&book_id=${book.id}" class="link resetLink">
                            <img src=${book.picture} alt="unplashArticle" class="image">
                            <div class="articleInfo">
                                <h4>${book.title}</h4>
                                <p class="autor">${book.autor}</p>
                                <p class="sellBy">Vendu par : ${book.seller}</p>
                            </div>
                        </a>
                    </div>
                `;
            });
            document.getElementById("books").innerHTML = html;
        });
}