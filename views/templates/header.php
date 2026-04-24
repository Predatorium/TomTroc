<header>
    <nav class="dropdownNav">

        <img src=<?= RESOURCES_PATH . "logo_nav.svg" ?> alt="Logo" class="logo">

        <div class="navMenu" id="nav-menu">
            
            <a href="index.php" class="Link resetLink">Accueil</a>
            <a href="index.php?action=books" class="Link resetLink">Nos livres à l’échange</a>
            <?php if (isset($_SESSION['user'])) { ?>
                <div class="Link">
                    <img src=<?= RESOURCES_PATH . "icon_messaging.svg" ?> alt="iconMessaging" class="iconMessaging">
                    <a href="index.php?action=messaging" class="resetLink">Messagerie</a>
                    <p class="newMsg" id="newMsgMobile"></p>
                </div>
                <div class="Link">
                    <img src=<?= RESOURCES_PATH . "icon_account.svg" ?> alt="iconAccount" class="iconAccount">
                    <a href="index.php?action=account" class="resetLink">Mon compte</a>
                </div>
                <a href="index.php?action=disconnectUser" class="Link resetLink">Déconnexion</a>
            <?php } else { ?>
                <a href="index.php?action=register" class="Link resetLink">Inscription</a>
                <a href="index.php?action=login" class="Link resetLink">Connexion</a>
            <?php } ?>

        </div>

        <button class="menu-toggle" id="menu-toggle">☰</button>

    </nav>
    <nav class = "mainNav">

        <div class="navLeft"> <img src = <?= RESOURCES_PATH . "logo_nav.svg" ?> alt="Logo"> 
            <a href="index.php" class = "Link resetLink"> Accueil </a> 
            <a href="index.php?action=books" class = "Link resetLink"> Nos livres à l’échange </a> 
        </div> 

        <div class="navRight">

            <?php if (isset($_SESSION['user'])) { ?>
                <div class="Link">
                    <img src=<?= RESOURCES_PATH . "icon_messaging.svg" ?> alt="iconMessaging" class="iconMessaging">
                    <a href="index.php?action=messaging" class="resetLink">Messagerie</a>
                    <p class="newMsg" id="newMsg"></p>
                </div>
                <div class="Link">
                    <img src=<?= RESOURCES_PATH . "icon_account.svg" ?> alt="iconAccount" class="iconAccount">
                    <a href="index.php?action=account" class="resetLink">Mon compte</a>
                </div>
                <a href="index.php?action=disconnectUser" class = "Link resetLink"> Déconnexion </a> 
            <?php }
            else { ?>
                <div></div>
                <a href="index.php?action=register" class = "Link resetLink"> Inscription </a> 
                <a href="index.php?action=login" class = "Link resetLink"> Connexion </a> 
            <?php } ?>

        </div> 

    </nav> 
</header>