<?php

    // COOKIE SECURITY //

    // Durée du cookie en secondes
    $_SESSION['cookieTime'] = 2678400;
    // Chemin du cookie
    $_SESSION['cookiePath'] = '/';
    // Domaine du cookie
    $_SESSION['cookieDomain'] = null;
    // Cookie généré uniquement en HTTPS
    $_SESSION['httpsOnly'] = false;
    // Cookie généré uniquement en HTTP   
    $_SESSION['httpOnly'] = false;

    // Library Controller //

    $_SESSION['entityByPage'] = 5; // Nombre d'élément par page de la Bibliothèque

?>