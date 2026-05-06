<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="exchange">
    <div class="head">
        <h1 class="titlePage">Nos livres à l’échange</h1>
        <div class="searchArea">
            <img src="<?= RESOURCES_PATH . "magnifier.svg" ?>" alt="loupe">
            <input type="text" id="searchInput" placeholder="Rechercher un livre...">
        </div>
    </div>
    <article class="books" id="books">
        <!-- Livres -->
    </article>
</div>