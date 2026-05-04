<?php
    /**
     * Affichage la page de reedition d'un livre.
     */
    /** @var Book $book */
?>

<div class="editBook">
    <a href="index.php?action=account" class="link resetLink"><img src = <?= RESOURCES_PATH . "back.svg" ?> alt="retour"> retour</a>
    <h3>Modifier les informations</h3>
    <form action="index.php?action=updateBook&book_id=<?= $book->getId() ?>" method="post" class="form row edit">
        <div class="formGrid grey picture">
            <p>Photo</p>
            <img src = <?= $book->getPicture() ?? "" ?> alt="illustration livre" class="imageBook">
            <div>
                <label for="picture" class="label">Picture</label>
                <input type="text" name="picture" id="picture" value="<?= htmlspecialchars($book->getPicture()) ?>" placeholder="URL picture">
            </div>
            <a href="" class="editPicture">Modifier la photo</a>
        </div>
        <div class="formGrid grey info">
            <div>
                <label for="title" class="label">Titre</label>
                <input type="text" name="title" id="title" value="<?= htmlspecialchars($book->getTitle()) ?>">
            </div>
            <div>
                <label for="author" class="label">Auteur</label>
                <input type="text" name="author" id="author" value="<?= htmlspecialchars($book->getAuthor()) ?>">
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