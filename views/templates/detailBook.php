<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="detailBookPage fullScreen">
    <p class="path">
        <a href="index.php?action=books" class="link resetLink" alt="retour">Nos livres</a> > <?= $book->getTitle() ?>
    </p>
    <div class="info">
        <img src =<?= $book->getPicture() ?> alt="Couverture du livre" class="imageDetailBook">
        <div class="bookdetail">
            <h1 class="title" alt="<?= $book->getTitle() ?>"><?= $book->getTitle() ?></h1>
            <p class="author" alt="<?= $book->getAuthor() ?>">par <?= $book->getAuthor() ?></p>
            <div class="divider"></div>
            <p class="description">DESCRIPTION</p>
            <div class="synopsis" alt="<?= Utils::format($book->getDescription()) ?>"><?= Utils::format($book->getDescription()) ?></div>
            <p class="owner">PROPRIÉTAIRE</p>
            <div class="userInfo">
                <a href="index.php?action=userProfil&user_id=<?= $book->getUserId() ?>" class="user resetLink" alt="lien profil utilisateur">
                    <img src =<?= $userManager->getUserById($book->getUserId())->getPicture() ?> alt="imageUser" class="imageUser">
                    <p class="pseudoUser"><?= $userManager->getUserById($book->getUserId())->getPseudo() ?></p>
                </a>
            </div>
            <?php if (!Utils::isMe($book->getUserId()) && isset($_SESSION['userId'])) {?>
                <a href="index.php?action=addConversation&user_id=<?= $book->getUserId() ?>" class="button green" alt="Envoyer un message">Envoyer un message</a>
            <?php } ?>
        </div>
    </div>
</div>