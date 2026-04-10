<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="exchange">
    <div class="head">
        <h1 class="">Nos livres à l’échange</h1>
        <div class="searchArea" id="searchArea">
            <img src="./resources/magnifier.svg" alt="loupe">
            <input type="text" id="searchInput" placeholder="Rechercher un livre...">
        </div>
    </div>
    <article class="articles">
        <?php  foreach ($books as $book){ ?>
            <div class="article">
                <a href="index.php?action=detailBook&book_id=<?= $book->getId() ?>" class="link resetLink">
                    <img src = <?= $book->getPicture() ?> alt="unplashArticle" class="image">
                    <div class="articleInfo">
                        <p><h3><?= $book->getTitle() ?></h3></p>
                        <p class="autor greyColor"><?= $book->getAutor() ?></p>
                        <p class="sellBy greyColor italic">Vendu par : <?= $userManager->getUserById($book->getUserId())->getPseudo() ?></p>
                    </div>
                </a>
            </div>
        <?php  }?>
    </article>
</div>