const searchInputBalise = document.getElementById("searchInput");
if (searchInputBalise != null) {
    searchInputBalise.addEventListener("input", e =>{
        loadBooks(e.target.value);
    });
}

function loadBooks(research) {
    fetch(`index.php?action=getBooks&research=${research}`)
        .then(res => res.json())
        .then(data => {
            let html = "";

            data.forEach(book => {
                html += `
                    <div class="book" alt="${book.title}" title="${book.title}">
                        <a href="index.php?action=detailBook&book_id=${book.id}" class="link resetLink">
                            <img src=${book.picture} alt="illustration livre" class="image">
                            <div class="bookInfo" alt="info livre">
                                <h4 class="title">${book.title}</h4>
                                <p class="author">${book.author}</p>
                                <p class="sellBy">Vendu par : ${book.seller}</p>
                            </div>
                        </a>
                    </div>
                `;
            });
            document.getElementById("books").innerHTML = html;
        });
}