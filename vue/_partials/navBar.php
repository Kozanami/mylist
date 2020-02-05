<nav class="navbar navbar-expand-lg sticky-top nav-bar-perso">
            <a class="navbar-brand"  href="<?= WEBROOT ?>Library/index">Memovie</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="topbar-divider d-none d-sm-block"></div>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <?php
                        if (isset($_SESSION['id']))
                        {
                    ?> 
                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>Library/index" class="nav-link">
                            Bibliothèque
                        </a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>User/index" class="nav-link"> Profil</a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <?php  
                        } 
                        else 
                        {
                    ?>

                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>User/signIn"  class="nav-link"> Inscription</a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>User/logIn"  class="nav-link"> Connexion</a>
                    </li>

                    <?php 
                        } 
                    ?>
                </ul>
                <ul class="navbar-nav ml-auto">
                <?php
                    
                    if (isset($_SESSION['id']))
                    {

                ?>

                    <li class="nav-item">
                        <a href="<?= WEBROOT ?>User/logOut" class="nav-link text-danger"> Déconnexion</a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <?php
                        if(isset($_SESSION['roleAdmin']) && $_SESSION['roleAdmin'] == 'ROLE_ADMIN')
                        {
                            echo '
                                <li class="navbar-nav  pr-1">
                                    <a class="nav-link text-danger" href="'.WEBROOT.'Admin/logOut">
                                        Déconnexion du Panel Admin
                                    </a>
                                </li>
                                <div class="topbar-divider d-none d-sm-block"></div>
                            ';
                        }
                        if($data->getRole() == 'ROLE_ADMIN')
                        {
                            echo '
                                <li class="navbar-nav pr-1">
                                    <a class="nav-link text-info" href="'.WEBROOT.'Admin/auth">
                            ';
                                    if(isset($_SESSION['roleAdmin']) && $_SESSION['roleAdmin'] == 'ROLE_ADMIN')
                                    {
                                        echo 'Panel Admin';
                                    }
                                    else
                                    {
                                        echo 'Connexion au Panel Admin';
                                    }
                            echo '
                                    </a>
                                </li>
                            ';
                        }
                    ?>
                    <?php if($data->getFirstName() != '' AND $data->getLastName() != ''){ echo '<div class="topbar-divider d-none d-sm-block"></div>'; } ?>
                    <!-- Nav Item - User Information -->
                    <li class="nav-item pr-1">
                        <a class="nav-link" href="<?= WEBROOT ?>User/index/">
                           <span class="mr-2 d-lg-inline text-gray-400 small font-weight-normal topbar-text-size"><?= $data->getFirstName().' '.$data->getLastName() ?></span>
                            <img src="<?= WEBROOT.'img/avatar/'.$data->getAvatar(); ?>" alt="image de profil" class="img-profile rounded-circle">
                        </a>
                    </li>
                <?php 
                        } 
                    ?>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item pr-1">
                        <i id="btnSwap" class="far fa-lightbulb fa-2x p-2"></i>
                    </li>
                </ul>
            </div>
        </nav>