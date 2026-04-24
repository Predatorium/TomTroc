<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="login fullScreen">
    <div class="left">
        <form action="index.php?action=addUser" method="post" class="form">
            <div class="formGrid white">
                <h2>Inscription</h2>
                <div>
                    <label for="pseudo" class="label">Pseudo</label>
                    <input class="whiteInput" type="text" name="pseudo" id="pseudo" required>
                </div>
                <div>
                    <label for="email" class="label">Adresse email</label>
                    <input class="whiteInput" type="email" name="email" id="email" required>
                </div>
                <div>
                    <label for="password" class="label">Mot de passe</label>
                    <input class="whiteInput" type="password" name="password" id="password" required>
                </div>
                <button class="button green">S’inscrire</button>
                <p>Déjà inscrit ? <a href="index.php?action=login" class="link">Connectez-vous</a></p>
            </div>
        </form>
    </div>
    <img src = <?= RESOURCES_PATH . "image_login.svg" ?> alt="imageLogin" class="imageLogin">
</div>