<?php
    /**
     * Affichage la page d'accueil.
     */
?>

<div class="home">
    <div class="discover">
        <div class="left">
            <div class="blockText fontSize16">
                <h1>Rejoignez nos lecteurs passionnés</h1>
                <p class="lightText">Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.
            </div>
            <p><a href="index.php?action=books" class="button green">Découvrir</a>
        </div>
        <div class="right">
            <img src = "./resources/unsplashHome.png" alt="unplashHome">
            <p class="greyColor italic fontSize12">Hamza
        </div>
    </div>
    <div class="lastBooks">
        <h2 class="titleCenter">Les derniers livres ajoutés</h2>
        <article class="articles">
            <?php  for ($article = 0; $article < 4; $article++){ ?>
                <div class="article">
                    <a href="index.php?action=detailBook" class="link resetLink">
                        <img src = "./resources/Esther.svg" alt="unplashArticle">
                        <div class="articleInfo">
                            <h3>Esther</h3>
                            <p class="autor greyColor">Alabaster</p>
                            <p class="sellBy greyColor italic">Vendu par : CamilleClubLit</p>
                        </div>
                    </a>
                </div>
            <?php  }?>
        </article>
        <p><a href="index.php?action=books" class="button green">Voir tous les livres</a>
    </div>
    <div class="about">
        <h2 class="titleCenter">Comment ça marche ?</h2>
        <p class="aboutSubsection lightText fontSize16">Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>
        <div class="aboutBox titleCenter fontSize14">
            <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
            <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
            <p>Parcourez les livres disponibles chez d'autres membres.</p>
            <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
        </div>
        <p><a href="index.php?action=books" class="button borderGreen">Voir tous les livres</a></p>
        <img src = "./resources/bannerAbout.svg" alt="banner" class="banner">
        <div class="aboutSubsection lightText fontSize16">
            <h2>Nos valeurs</h2>
            <br>
            <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et 
                notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
            <br>
            <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
            <br>
            <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger 
                des livres qui attendent patiemment sur les étagères.</p>
            <br>
            <div class="signed">
                <p class="greyColor italic fontSize12">L’équipe Tom Troc</p>
                <img src = "./resources/heart.svg" alt="coeur" class="heart">
            </div>
        </div>
    </div>
</div>