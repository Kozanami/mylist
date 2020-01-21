<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="<?= WEBROOT ?>css/bootstrap.css">
        <link rel="stylesheet" href="<?= WEBROOT ?>css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    </head>
        
    <body>

        <!-- Navbar content -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
            <a class="navbar-brand"  href="<?= WEBROOT ?>Library/index">Maliste</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <!-- Button home

                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Bibliothèque
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= WEBROOT ?>Library/index">Toute la Bibliothèque</a>
                            <a class="dropdown-item" href="<?= WEBROOT ?>Library/index/Film">Les Films</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= WEBROOT ?>Library/index/Series">Les Séries</a>
                        </div>
                    </li>

                    <?php 
                    
                        if (isset($_SESSION['id']))
                        {

                    ?>

                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>User/logOut" class="nav-link"> Déconnexion</a>
                    </li>

                    <?php  
                        } 
                        else 
                        {
                    ?>

                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>User/signIn">Inscription</a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>User/logIn">Connexion</a>
                    </li>

                    <?php 
                        } 
                    ?>

                </ul>
            </div>
        </nav>

        <!-- Header content -->
        <header></header>
        

        <main class="container-fluid">
        <?= $content ?>
        </main>

        <!-- Footer content -->
        <footer>
        </footer>

    </body>
</html>