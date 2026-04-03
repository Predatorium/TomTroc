<header>
    <nav class = "mainNav titleCenter fontSize14">
        <div class="navLeft">
            <img src = "./resources/logoNav.svg" alt="Logo">
            <a href="index.php" class = "Link resetLink"> Accueil </a>
            <a href="index.php?action=books" class = "Link resetLink"> Nos livres à l’échange </a>
        </div>
        <div class="navRight">
            <?php if (isset($_SESSION['user']) && isset($_SESSION['idUser'])) {   ?>
                <a href="index.php?action=conversasion" class = "Link resetLink"> Messagerie </a>
                <a href="index.php?action=account&userId=<?= $_SESSION['idUser'] ?>" class = "Link resetLink"> Mon compte </a>
                <a href="index.php?action=disconnectUser" class = "Link resetLink"> Déconnexion </a>
                <?php }
            else { ?>
                <a href="index.php?action=login" class = "Link resetLink"> Messagerie </a>
                <a href="index.php?action=login" class = "Link resetLink"> Mon compte </a>
                <a href="index.php?action=login" class = "Link resetLink"> Connexion </a>
            <?php } ?>
        </div>
    </nav>
</header>