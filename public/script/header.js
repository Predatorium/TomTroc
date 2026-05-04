/**
 * Script en lien avec la navigation dans le header.
 */

const toggle = document.getElementById("menu-toggle");      // Icone qui sert à afficher le menu deroulant 
const menu = document.getElementById("nav-menu");           // Le menu deroulant
const messaging = document.getElementById("newMsg");        // Champ nombre de conversation non lue
const msgMobile = document.getElementById("newMsgMobile");  // Champ nombre de conversation non lue pour mobile

// On verifie qu'on a bien reussi à recuperer le toggle.
if (toggle != null){
    toggle.addEventListener("click", () => {
        menu.classList.toggle("active");
    });
}

if (messaging != null && msgMobile != null) {
    getCountUnreadConversations();
    setInterval(getCountUnreadConversations, 2000);
}

// On modifie le champ pour afficher le nombre de conversation non lue.
function getCountUnreadConversations() {
    fetch(`index.php?action=getCountUnreadConversations`)
    .then(res => res.json())
    .then(data => {
        messaging.textContent=data;
        msgMobile.textContent=data;
    });
}