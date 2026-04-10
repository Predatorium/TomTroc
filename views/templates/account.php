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
                    <img src = <?= $user->getPicture()?> alt="profilPicture" class="profilPicture">
                    <a href="">modifier</a>
                </div>
                <div>
                    <p class ="pseudo"><?= $user->getPseudo()?></p>
                    <p class="listedSince">Membre depuis <?= Utils::dateSince($user->getDateCreation()) ?></p>
                    <p class="library">BIBLIOTHEQUE</p>
                    <p class="nbBooks">
                        <img src = "./resources/iconeBook.svg"> 
                        <?= count($books)?> livre<?= count($books) > 1 ? "s" : ""?>
                    </p>
                </div>
            </div>
            <div class="right">
                <form action="index.php?action=updateUser&userId=<?= $userId ?>" method="post" class="form">
                    <h3>Vos informations personnelles</h3>
                    <div class="formGrid grey">
                        <div>
                            <label for="email" class="greyColor">Adresse email</label>
                            <input type="email" name="email" id="email" placeholder=<?= $user->getEmail()?>>
                        </div>
                        <div>
                            <label for="password" class="greyColor">Mot de passe</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div>
                            <label for="pseudo" class="greyColor">Pseudo</label>
                            <input type="text" name="pseudo" id="pseudo" placeholder=<?= $user->getPseudo()?>>
                        </div>
                    </div>
                    <button class="button borderGreen">Enregistrer</button>
                </form>
            </div>
        </div>
        <article class="accountBooks">
            <div class="legend">
                <p>PHOTO</p>
                <p>TITRE</p>
                <p>AUTEUR</p>
                <p>DESCRIPTION</p>
                <p>DISPONIBILITE</p>
                <p>ACTION</p>
            </div>
            <?php  foreach ($books as $book){ ?>
                <div class="book">
                    <img src = <?= $book->getPicture() ?> alt="image" class="image">
                    <p><?= $book->getTitle() ?></p>
                    <p><?= $book->getAutor() ?></p>
                    <p><?= $book->getDescription(120) ?></p>
                    <p class=<?= $book->getAvailable() ? "available" : "unavailable" ?>><?= $book->getAvailableToString() ?></p>
                    <div class="action">
                        <a href="index.php?action=editBook&book_id=<?= $book->getId() ?>" class="edit">Éditer</a>
                        <a href="index.php?action=deleteBook&book_id=<?= $book->getId() ?>" class="delete">Supprimer</a>
                    </div>
                </div>
            <?php  }?>
            <a href="index.php?action=newBook" class="buttonAdd">+</a>
        </article>
    </div>
</div>