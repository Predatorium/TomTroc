<?php
    /**
     * Affichage la page de detail d'un livre.
     */
    /** @var Book $book */
    /** @var UserManager $userManager */
?>

<div class="detailBookPage fullScreen">
    <p class="path">
        <a href="index.php?action=books" class="link resetLink" title="retour">Nos livres</a> > <?= $book->getTitle() ?>
    </p>
    <div class="info">
        <img src="<?= $book->getPicture() ?>" alt="Couverture du livre" class="imageDetailBook">
        <div class="bookdetail">
            <h1 class="title"><?= $book->getTitle() ?></h1>
            <p class="author">par <?= $book->getAuthor() ?></p>
            <div class="divider"></div>
            <p class="description">DESCRIPTION</p>
            <div class="synopsis"><?= Utils::format($book->getDescription()) ?></div>
            <p class="owner">PROPRIÉTAIRE</p>
            <div class="userInfo">
                <a href="index.php?action=userProfil&user_id=<?= $book->getUserId() ?>" class="user resetLink" title="lien profil utilisateur">
                    <img src="<?= $userManager->getUserById($book->getUserId())->getPicture() ?>" alt="imageUser" class="imageUser">
                    <p class="pseudoUser"><?= $userManager->getUserById($book->getUserId())->getPseudo() ?></p>
                </a>
            </div>
            <?php if (!Utils::isMe($book->getUserId()) && isset($_SESSION['userId'])) {?>
                <a href="index.php?action=addConversation&user_id=<?= $book->getUserId() ?>" class="button green">Envoyer un message</a>
            <?php } ?>
        </div>
    </div>
</div>