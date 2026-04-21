<?php
    /**
     * Affichage la page d'échange de livres.
     */
?>

<div class="editBook">
    <a href="index.php?action=account" class="link resetLink"><img src="./resources/back.svg" alt="backpage"> retour</a>
    <h3>Modifier les informations</h3>
    <div class="edit">
        <div class="picture">
            <p>Photo</p>
            <img src = <?= $book->getPicture() ?? "" ?> alt="imageBook" class="imageBook">
            <a href="" class="editPicture">Modifier la photo</a>
        </div>
        <div class="info">
            <form action="index.php?action=updateBook&book_id=<?= $book->getId() ?>" method="post" class="form">
                <div class="formGrid grey">
                    <div>
                        <label for="title" class="label">Titre</label>
                        <input type="text" name="title" id="title" value="<?= htmlspecialchars($book->getTitle()) ?>">
                    </div>
                    <div>
                        <label for="autor" class="label">Auteur</label>
                        <input type="text" name="autor" id="autor" value="<?= htmlspecialchars($book->getAutor()) ?>">
                    </div>
                    <div class="textArea">
                        <label for="comment" class="label">Commentaire</label>
                        <textarea name="comment" id="comment"><?= htmlspecialchars($book->getDescription()) ?></textarea>
                    </div>
                    <div>
                        <label for="available" class="label">Disponibilité</label>
                        <select name="available" id="available">
                            <option value="1" <?= $book->getAvailable() ? "selected" : "" ?>>Disponible</option>
                            <option value="0" <?= $book->getAvailable() ? "" : "selected" ?>>Indisponible</option>
                        </select>
                    </div>
                    <button class="button green">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>