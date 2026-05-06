/**
 * Script en lien avec les pages dédiées aux livres.
 */

//On essaie de recuperer l'element avec l'id "searchInput".
const searchInputBalise = document.getElementById("searchInput");
if (searchInputBalise != null) {
    searchInputBalise.addEventListener("input", e =>{
        loadBooks(e.target.value);
    });
}

// fonction qui permet de generer le code html pour chaque vignettes de livre.
function loadBooks(research) {
    fetch(`index.php?action=getBooks&research=${research}`)
        .then(res => res.json())
        .then(data => {
            let html = "";

            data.forEach(book => {
                html += `
                    <div class="book">
                        <a href="index.php?action=detailBook&book_id=${book.id}" class="link resetLink" title="${book.title}">
                            <img src=${book.picture} alt="illustration livre" class="image">
                            <div class="bookInfo">
                                <h2 class="title">${book.title}</h2>
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