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
        <title>TomTroc</title>
        <link rel="stylesheet" href="./css/style.css">
        <?php require_once './resources/fonts.php'; ?>
        <script src = "./script/script.js" defer> </script>
    </head>

    <body>
        
        <?php require_once TEMPLATE_VIEW_PATH . 'header.php'; ?>

        <main id="content">
            <?= $content ?>
        </main>
      
        <?php require_once TEMPLATE_VIEW_PATH . 'footer.php'; ?>

    </body>
</html>