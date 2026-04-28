<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="login fullScreen">
    <div class="left">
        <form action="index.php?action=connectUser" method="post" class="form" id="sendForm">
            <div class="formGrid white">
                <h2>Connexion</h2>
                <p class="errorMsg" id="errorMsg">Utilisateur ou mot de passe non valide.</p>
                <div>
                    <label for="email" class="label">Adresse email</label>
                    <input type="email" name="email" id="email" placeholder="patrick.renaud@gmail.com" autocomplete="email">
                </div>
                <div>
                    <label for="password" class="label">Mot de passe</label>
                    <input type="password" name="password" id="password">
                </div>
                <button class="button green">Se connecter</button>
                <p>Pas de compte ? <a href="index.php?action=register" class="link">Inscrivez-vous</a></p>
            </div>
        </form>
    </div>
    <img src = <?= RESOURCES_PATH . "image_login.svg" ?> alt="imageLogin" class="imageLogin">
</div>