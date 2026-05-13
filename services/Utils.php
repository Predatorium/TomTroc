<?php

/**
 * Classe utilitaire : cette classe ne contient que des méthodes statiques qui peuvent être appelées
 * directement sans avoir besoin d'instancier un objet Utils.
 * Exemple : Utils::redirect('home'); 
 */

class Utils {
    /**
     * Convertit une date vers le format de type "Samedi 15 juillet 2023" en francais.
     * @param DateTime $date : la date à convertir.
     * @return string : la date convertie.
     */
    public static function convertDateToFrenchFormat(DateTime $date) : string
    {
        // Attention, s'il y a un soucis lié à IntlDateFormatter c'est qu'il faut
        // activer l'extention intl_date_formater (ou intl) au niveau du serveur apache. 
        // Ca peut se faire depuis php.ini ou parfois directement depuis votre utilitaire (wamp/mamp/xamp)
        $dateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $dateFormatter->setPattern('EEEE d MMMM Y');
        return $dateFormatter->format($date);
    }
    
    /**
     * Cette méthode permet de récupérer une variable de la superglobale $_REQUEST.
     * Si cette variable n'est pas définie, on retourne la valeur null (par défaut)
     * ou celle qui est passée en paramètre si elle existe.
     * @param string $variableName : le nom de la variable à récupérer.
     * @param mixed $defaultValue : la valeur par défaut si la variable n'est pas définie.
     * @return mixed : la valeur de la variable ou la valeur par défaut.
     */
    public static function request(string $variableName, mixed $defaultValue = null) : mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }

    /**
     * Redirige vers une URL.
     * @param string $action : l'action que l'on veut faire (correspond aux actions dans le routeur).
     * @param array $params : Facultatif, les paramètres de l'action sous la forme ['param1' => 'valeur1', 'param2' => 'valeur2']
     * @return void
     */
    public static function redirect(string $action, array $params = []) : void
    {
        $url = "index.php?action=$action";
        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }
        header("Location: $url");
        exit();
    }

    /**
     * Cette méthode protège une chaine de caractères contre les attaques XSS.
     * De plus, elle transforme les retours à la ligne en balises <p> pour un affichage plus agréable.
     * @param string $string : la chaine à protéger.
     * @return string : la chaine protégée.
     */
    public static function format(string $string) : string
    {
        // 1. Corrige les entités HTML déjà présentes (évite le double encodage)
        $string = htmlspecialchars_decode($string, ENT_QUOTES);

        // 2. Normalise tous les types de retours à la ligne
        $string = preg_replace('/\r\n|\r/', "\n", $string);

        // 3. Sépare les paragraphes (une ou plusieurs lignes vides = nouveau paragraphe)
        $paragraphs = preg_split('/\n\s*\n/', trim($string));

        // 4. Sécurise + encapsule en <p>
        $html = "";
        foreach ($paragraphs as $p) {
            $p = htmlspecialchars(trim($p), ENT_QUOTES, 'UTF-8');
            $p = nl2br($p);
            $html .= "<p>$p</p><br>";
        }

        return $html;
    }

    /**
     * Cette methode permet de recuperer en chaine de caractere le temps ecoulé depuis une date.
     * @param DateTime $date.
     * @return string
     */
    public static function dateSince(DateTime $date) : string
    {
        $now = new DateTime();
        $interval = $date->diff($now);

        if ($interval->y > 0){
            return $interval->y . " an" . ($interval->y > 1 ? "s" : ""); 
        }
        else if ($interval->m > 0){
            return $interval->m . " mois";
        }
        return $interval->d . " jour" . ($interval->d > 1 ? "s" : "");
    }

    /**
     * Cette methode permet de savoir si l'id correspond à l'utilisateur connecté.
     * @param int $userId.
     * @return bool
     */
    public static function isMe(int $userId): bool
    {
        if (isset($_SESSION['userId'])) {
            return $userId === $_SESSION["userId"]; 
        }
        
        return false;
    }

    /**
     * Cette methode permet de rediriger vers la page de connection si le visiteur n'est pas connecté.
     * @return void
     */
    public static function checkIfUserIsConnected() : void
    {
        // On vérifie que l'utilisateur est connecté.
        if (!isset($_SESSION['user'])) {
            Utils::redirect("login");
        }
    }

    /**
     * Cette methode permet de retourner selected pour le menu de navigation.
     * @param int $indexSelected : l'index selectionner.
     * @param int $index : l'index de l'élement.
     * @return string
     */
    public static function isSelected(int $index, ?int $indexSelected = -1) : string
    {
        return $indexSelected == $index ? 'selected' : '';
    }
}