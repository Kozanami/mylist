<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" id="navBarMargin">
            <a class="navbar-brand"  href="<?= WEBROOT ?>Library/index">Maliste</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Bibliothèque
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= WEBROOT ?>Library/index">Toute la Bibliothèque</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= WEBROOT ?>Library/film">Les Films</a>
                            <a class="dropdown-item" href="<?= WEBROOT ?>Library/serie">Les Séries</a>
                            <a class="dropdown-item" href="<?= WEBROOT ?>Library/anime">Les Animés</a>
                            <a class="dropdown-item" href="<?= WEBROOT ?>Library/dessinAnime">Les Déssin Animés</a>
                            <a class="dropdown-item" href="<?= WEBROOT ?>Library/courtMetrage">Les Court Métrages</a>

                        </div>
                    </li>

                    <?php
                    
                        if (isset($_SESSION['id']))
                        {

                    ?>
                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>User/index" class="nav-link"> Profil</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>User/logOut" class="nav-link"> Déconnexion</a>
                    </li>

                    <?php  
                        } 
                        else 
                        {
                    ?>

                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>User/signIn"  class="nav-link"> Inscription</a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>User/logIn"  class="nav-link"> Connexion</a>
                    </li>

                    <?php 
                        } 
                    ?>

                </ul>
            </div>
        </nav>