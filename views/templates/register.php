<?php
    /**
     * Affichage la d'incription.
     */
?>

<div class="login fullScreen">
    <div class="left">
        <form action="index.php?action=addUser" method="post" class="form" id="sendForm">
            <div class="formGrid white">
                <h2>Inscription</h2>
                <div>
                    <label for="pseudo" class="label">Pseudo</label>
                    <input type="text" id="pseudo" name="pseudo" placeholder="Patrick (15 caractères max)">
                </div>
                <div>
                    <label for="email" class="label">Adresse email</label>
                    <input type="email" id="email" name="email" autocomplete="email" placeholder="patrick.renaud@gmail.com">
                </div>
                <div>
                    <label for="password" class="label">Mot de passe</label>
                    <input type="password" id="password" name="password">
                </div>
                <button class="button green">S’inscrire</button>
                <p>Déjà inscrit ? <a href="index.php?action=login" class="link">Connectez-vous</a></p>
            </div>
        </form>
    </div>
    <img src = <?= RESOURCES_PATH . "image_login.svg" ?> alt="imageLogin" class="imageLogin">
</div>