<?php 
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= "TomTroc - " . $title ?></title>
        <link rel="stylesheet" href="./public/css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <script src = "./public/script/header.js" defer> </script>
        <script src = "./public/script/books.js" defer> </script>
        <script src = "./public/script/messaging.js" defer> </script>
        <script src = "./public/script/main.js" defer> </script>
    </head>

    <body data-page="<?= $title ?? '' ?>">
        
        <?php require_once TEMPLATE_VIEW_PATH . 'header.php'; ?>

        <main id="content">
            <?= $content ?>
        </main>
      
        <?php require_once TEMPLATE_VIEW_PATH . 'footer.php'; ?>

    </body>
</html>