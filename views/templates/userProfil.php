<?php
    /**
     * Affichage du profil d'un utilisateur.
     */
    /** @var User $user */
    /** @var array $books */
?>

<div class="userProfil">
    <div class="userInfo">
        <img src=<?= $user->getPicture()?> alt="profilPicture" class="profilPicture">
        <div class="divider"></div>
        <div>
            <p class ="pseudo"><?= $user->getPseudo()?></p>
            <p class="listedSince">Membre depuis <?= Utils::dateSince($user->getDateCreation()) ?></p>
            <p class="library">BIBLIOTHEQUE</p>
            <p class="nbBooks">
                <img src=<?= RESOURCES_PATH . "icone_book.svg" ?>> 
                <?= count($books)?> livre<?= count($books) > 1 ? "s" : ""?>
            </p>
        </div>
        <?php if ($user->getId() !== $_SESSION["userId"]) {?>
            <a href="index.php?action=addConversation&user_id=<?= $user->getId() ?>" class="button borderGreen">Écrire un message</a>
        <?php } ?>
    </div>
    <article class="userBooks">
        <div class="legend">
            <p>PHOTO</p>
            <p>TITRE</p>
            <p>AUTEUR</p>
            <p>DESCRIPTION</p>
        </div>
        <?php  foreach ($books as $book){ ?>
            <div class="book">
                <img src = <?= $book->getPicture() ?> alt="image" class="image">
                <div class="title"><p><?= $book->getTitle() ?></p></div>
                <div class="author"><p><?= $book->getAuthor() ?></p></div>
                
                
                <p class="descrip"><?= $book->getDescription(120) ?></p>
            </div>
        <?php  }?>
    </article>
</div>