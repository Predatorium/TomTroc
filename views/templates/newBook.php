<?php
    /**
     * Affichage la page d'edition d'un nouveau livre.
     */
?>

<div class="editBook">
    <a href="index.php?action=account" class="link resetLink"><img src="./resources/back.svg" alt="backpage"> retour</a>
    <h3>Créer un livre</h3>
    <form action="index.php?action=addBook" method="post" class="form row edit">
        <div class="formGrid grey picture">
            <p>Photo</p>
            <img src="" alt="imageBook" class="imageBook">
            <div>
                <label for="picture" class="label">Picture</label>
                <input type="text" name="picture" id="picture" placeholder="URL picture" required>
            </div>
            <a href="" class="editPicture">Modifier la photo</a>
        </div>
        <div class="formGrid grey info">
            <div>
                <label for="title" class="label">Titre</label>
                <input type="text" name="title" id="title" placeholder="Titre" required>
            </div>
            <div>
                <label for="author" class="label">Auteur</label>
                <input type="text" name="author" id="author" placeholder="Auteur" required>
            </div>
            <div class="textArea">
                <label for="comment" class="label">Commentaire</label>
                <textarea name="comment" id="comment" placeholder="Commentaire"></textarea>
            </div>
            <div>
                <label for="available" class="label">Disponibilité</label>
                <select name="available" id="available">
                    <option value="1" selected>Disponible</option>
                    <option value="0">Indisponible</option>
                </select>
            </div>
            <button class="button green">Valider</button>
        </div>
    </form>
</div>