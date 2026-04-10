<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="detailBookPage fullScreen">
    <img src =<?= $book->getPicture() ?> alt="imageDetailBook" class="imageDetailBook">
    <div class="right">
        <div class="bookdetail">
            <h1 class="title"><?= $book->getTitle() ?></h1>
            <p class="fontSize16 greyColor">par <?= $book->getAutor() ?></p>
            <p class="description">DESCRIPTION</p>
            <p class="fontSize14"><?= Utils::format($book->getDescription()) ?></p>
            <p>PROPRIÉTAIRE</p>
            <a href="index.php?action=userProfil&user_id=<?= $book->getUserId() ?>" class="autor resetLink">
                <img src =<?= $userManager->getUserById($book->getUserId())->getPicture() ?> alt="imageAutor" class="imageAutor">
                <p class="fontSize14"><?= $userManager->getUserById($book->getUserId())->getPseudo() ?></p>
            </a>
        </div>
        <?php if (!Utils::isMyBook($book->getUserId())) {?>
            <p><a href="index.php?action=sendMessage&user_id=<?= $book->getUserId() ?>" class="button green">Envoyer un message</a>
        <?php } ?>
    </div>
</div>