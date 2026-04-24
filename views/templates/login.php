<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="login fullScreen">
    <div class="left">
        <form action="index.php?action=connectUser" method="post" class="form">
            <div class="formGrid white">
                <h2>Connexion</h2>
                <div>
                    <label for="email" class="label">Adresse email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div>
                    <label for="password" class="label">Mot de passe</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button class="button green">Se connecter</button>
                <p>Pas de compte ? <a href="index.php?action=register" class="link">Inscrivez-vous</a></p>
            </div>
        </form>
    </div>
    <img src = <?= RESOURCES_PATH . "image_login.svg" ?> alt="imageLogin" class="imageLogin">
</div>