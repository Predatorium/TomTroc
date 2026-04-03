<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="login">
    <div class="left">
        <form action="index.php?action=addUser" method="post" class="form">
            <h2>Inscription</h2>
            <div class="formGrid">
                <div>
                    <label for="pseudo" class="greyColor">Pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" required>
                </div>
                <div>
                    <label for="email" class="greyColor">Adresse email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div>
                    <label for="password" class="greyColor">Mot de passe</label>
                    <input type="password" name="password" id="password" required>
                </div>
            </div>
            <button class="button green">S’inscrire</button>
            <p>Déjà inscrit ? <a href="index.php?action=login">Connectez-vous</a></p>
        </form>
    </div>
    <img src = "./resources/imageLogin.svg" alt="imageLogin" class="imageLogin">
</div>