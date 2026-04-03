<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="login">
    <div class="left">
        <form action="index.php?action=connectUser" method="post" class="form">
            <h2>Connexion</h2>
            <div class="formGrid">
                <div>
                    <label for="email" class="greyColor">Adresse email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div>
                    <label for="password" class="greyColor">Mot de passe</label>
                    <input type="password" name="password" id="password" required>
                </div>
            </div>
            <button class="button green">Se connecter</button>
            <p>Pas de compte ? <a href="index.php?action=register">Inscrivez-vous</a></p>
        </form>
    </div>
    <img src = "./resources/imageLogin.svg" alt="imageLogin" class="imageLogin">
</div>