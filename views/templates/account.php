<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="accountContainer">
    <h1>Mon compte</h1>
    <div class="userInfo">
        <div class="left">
            <div>
                <img src = <?= $user->getPicture()?> alt="profilPicture" class="profilPicture">
                <a href="" class="editPicture">modifier</a>
            </div>
            <div class="divider"></div>
            <div>
                <p class ="pseudo"><?= $user->getPseudo()?></p>
                <p class="listedSince">Membre depuis <?= Utils::dateSince($user->getDateCreation()) ?></p>
                <p class="library">BIBLIOTHEQUE</p>
                <p class="nbBooks">
                    <img src = <?= RESOURCES_PATH . "icone_book.svg" ?>> 
                    <?= count($books)?> livre<?= count($books) > 1 ? "s" : ""?>
                </p>
            </div>
        </div>
        <div class="right">
            <form action="index.php?action=updateUser&user_id=<?= $userId ?>" method="post" class="form">
                <div class="formGrid grey">
                    <h4>Vos informations personnelles</h4>
                    <div>
                        <label for="email" class="label">Adresse email</label>
                        <input type="email" name="email" id="email" value=<?= $user->getEmail()?>>
                    </div>
                    <div>
                        <label for="password" class="label">Mot de passe</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div>
                        <label for="pseudo" class="label">Pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" value=<?= $user->getPseudo()?>>
                    </div>
                    <button class="button borderGreen resize">Enregistrer</button>
                </div>
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
                <p class="title"><?= $book->getTitle() ?></p>
                <p class="author"><?= $book->getAuthor() ?></p>
                <p class="descrip"><?= $book->getDescription(120) ?></p>
                <p class=<?= $book->getAvailable() ? "available" : "unavailable" ?>><?= $book->getAvailableToString() ?></p>
                <div class="action">
                    <a href="index.php?action=editBook&book_id=<?= $book->getId() ?>" class="edit">Éditer</a>
                    <a href="index.php?action=deleteBook&book_id=<?= $book->getId() ?>" class="delete">Supprimer</a>
                </div>
            </div>
        <?php  }?>
        <a href="index.php?action=newBook" class="buttonAdd" alt="ajouter un nouveau livre" title="ajouter un nouveau livre">+</a>
    </article>
</div>