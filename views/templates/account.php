<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="account">
    <div class="accountContainer">
        <h1>Mon compte</h1>
        <div class="userInfo">
            <div class="left">
                <div>
                    <img src = "./resources/imageAutor.svg" alt="imageAutor" class="imageAutor">
                    <a href="">modifier</a>
                </div>
                <div>
                    <p>nathalire</p>
                    <p>Membre depuis 1 an</p>
                    <p>BIBLIOTHEQUE</p>
                    <p><img src = "">4 livres</p>
                </div>
            </div>
            <div class="right">
                <form action="index.php?action=updateUser&userId=<?= $_SESSION['idUser'] ?>" method="post" class="form">
                    <h3>Vos informations personnelles</h3>
                    <div class="formGrid">
                        <div>
                            <label for="email" class="greyColor">Adresse email</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div>
                            <label for="password" class="greyColor">Mot de passe</label>
                            <input type="password" name="password" id="password" required>
                        </div>
                        <div>
                            <label for="pseudo" class="greyColor">Pseudo</label>
                            <input type="text" name="pseudo" id="pseudo" required>
                        </div>
                    </div>
                    <button class="button borderGreen">Enregistrer</button>
                </form>
            </div>
        </div>
        <article class="accountArticles">
            <div class="legend">
                <p>PHOTO</p>
                <p>TITRE</p>
                <p>AUTEUR</p>
                <p>DESCRIPTION</p>
                <p>DISPONIBILITE</p>
                <p>ACTION</p>
            </div>
            <?php  for ($article = 0; $article < 4; $article++){ ?>
                <div class="article">
                    <img src = "./resources/imageDetailBook.png" alt="imageDetailBook">
                    <p>The Kinkfolk Table</p>
                    <p>Nathan Williams</p>
                    <p>J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté pa</p>
                    <p class="available">disponible</p>
                    <div class="action">
                        <a href="index.php?action=account">Éditer</a>
                        <a href="index.php?action=account">Supprimer</a>
                    </div>
                </div>
            <?php  }?>
        </article>
    </div>
</div>