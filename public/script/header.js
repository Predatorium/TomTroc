const toggle = document.getElementById("menu-toggle");
const menu = document.getElementById("nav-menu");
const messaging = document.getElementById("newMsg");
const msgMobile = document.getElementById("newMsgMobile");

toggle.addEventListener("click", () => {
    menu.classList.toggle("active");
});

if (messaging != null && msgMobile != null) {
    getCountUnreadConversations();
    setInterval(getCountUnreadConversations, 2000);
}

function getCountUnreadConversations() {
    fetch(`index.php?action=getCountUnreadConversations`)
    .then(res => res.json())
    .then(data => {
        messaging.textContent=data;
        msgMobile.textContent=data;
    });
}