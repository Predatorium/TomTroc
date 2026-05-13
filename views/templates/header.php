<?php
    /**
     * Affichage le header du site.
     */
    /** @var int $selected */
?>

<header>
    <nav class="dropdownNav">

        <img src="<?= RESOURCES_PATH . "logo_nav.svg" ?>" alt="Logo" class="logo">

        <div class="navMenu" id="nav-menu">
            
            <a href="index.php" class="<?= implode(' ', array_filter(['Link', Utils::isSelected(0, $selected), 'resetLink'])) ?>">Accueil</a>
            <a href="index.php?action=books" class="<?= implode(' ', array_filter(['Link', Utils::isSelected(1, $selected), 'resetLink'])) ?>">Nos livres à l’échange</a>
            <?php if (isset($_SESSION['user'])) { ?>
                <a href="index.php?action=messaging" class="<?= implode(' ', array_filter(['Link', Utils::isSelected(2, $selected), 'resetLink'])) ?>">
                    <img src="<?= RESOURCES_PATH . "icon_messaging.svg" ?>" alt="iconMessaging" class="iconMessaging">
                    <span>Messagerie</span>
                    <span class="newMsg" id="newMsgMobile"></span>
                </a>
                <a href="index.php?action=account" class="<?= implode(' ', array_filter(['Link', Utils::isSelected(3, $selected), 'resetLink'])) ?>">
                    <img src="<?= RESOURCES_PATH . "icon_account.svg" ?>" alt="iconAccount" class="iconAccount">
                    <span>Mon compte</span>
                </a>
                <a href="index.php?action=disconnectUser" class="Link resetLink">Déconnexion</a>
            <?php } else { ?>
                <a href="index.php?action=register" class="<?= implode(' ', array_filter(['Link', Utils::isSelected(2, $selected), 'resetLink'])) ?>">Inscription</a>
                <a href="index.php?action=login" class="<?= implode(' ', array_filter(['Link', Utils::isSelected(3, $selected), 'resetLink'])) ?>">Connexion</a>
            <?php } ?>

        </div>

        <button class="menu-toggle" id="menu-toggle">☰</button>

    </nav>
    <nav class = "mainNav">

        <div class="navLeft"> <img src="<?= RESOURCES_PATH . "logo_nav.svg" ?>" alt="Logo"> 
            <a href="index.php" class = "<?= implode(' ', array_filter(['Link', Utils::isSelected(0, $selected), 'resetLink'])) ?>"> Accueil </a> 
            <a href="index.php?action=books" class = "<?= implode(' ', array_filter(['Link', Utils::isSelected(1, $selected), 'resetLink'])) ?>"> Nos livres à l’échange </a> 
        </div> 

        <div class="navRight">

            <?php if (isset($_SESSION['user'])) { ?>
                <a href="index.php?action=messaging" class="<?= implode(' ', array_filter(['Link', Utils::isSelected(2, $selected), 'resetLink'])) ?>">
                    <img src="<?= RESOURCES_PATH . "icon_messaging.svg" ?>" alt="iconMessaging" class="iconMessaging">
                    <span>Messagerie</span>
                    <span class="newMsg" id="newMsg"></span>
                </a>
                <a href="index.php?action=account" class="<?= implode(' ', array_filter(['Link', Utils::isSelected(3, $selected), 'resetLink'])) ?>">
                    <img src="<?= RESOURCES_PATH . "icon_account.svg" ?>" alt="iconAccount" class="iconAccount">
                    <span>Mon compte</span>
                </a>
                <a href="index.php?action=disconnectUser" class = "Link resetLink"> Déconnexion </a> 
            <?php }
            else { ?>
                <div></div>
                <a href="index.php?action=register" class = "<?= implode(' ', array_filter(['Link', Utils::isSelected(2, $selected), 'resetLink'])) ?>"> Inscription </a> 
                <a href="index.php?action=login" class = "<?= implode(' ', array_filter(['Link', Utils::isSelected(3, $selected), 'resetLink'])) ?>"> Connexion </a> 
            <?php } ?>

        </div> 

    </nav> 
</header>