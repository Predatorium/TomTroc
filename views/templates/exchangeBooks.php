<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="exchange">
    <div class="head">
        <h1 class="">Les derniers livres ajoutés</h1>
        <input type="text" id="searchInput" placeholder="Rechercher un livre...">
    </div>
    <article class="articles">
        <?php  for ($article = 0; $article < 16; $article++){ ?>
            <div class="article">
                <a href="index.php?action=detailBook" class="link resetLink">
                    <img src = "./resources/Esther.svg" alt="unplashArticle">
                    <div class="articleInfo">
                        <p><h3>Esther</h3></p>
                        <p class="autor greyColor">Alabaster</p>
                        <p class="sellBy greyColor italic">Vendu par : CamilleClubLit</p>
                    </div>
                </a>
            </div>
        <?php  }?>
    </article>
</div>