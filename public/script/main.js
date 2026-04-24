const isMobile = window.matchMedia("(max-width: 768px)").matches;
const params = new URLSearchParams(window.location.search);

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