<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Memovie : <?= $_SESSION['title'] ?></title>
        <meta name="description" content="Memovie vous aidera à vous rappellez ce que vous avez regarder et plus encore !" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="<?= WEBROOT ?>css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= WEBROOT ?>css/structure.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <?php 
            if(isset($_COOKIE['color']))
            {
                $color = $_COOKIE['color'];
            }
            else
            {
                $color = "dark";
                setcookie('color',$color,time()+31556926,$_SESSION['cookiePath'],$_SESSION['cookieDomain'],$_SESSION['httpsOnly'],$_SESSION['httpOnly']);
            }
        ?>
        <link rel="stylesheet" type="text/css" href="<?= WEBROOT ?>css/style-<?= $color ?>.css" id="<?= $color ?>">

    </head>
    <body>
        <!-- Navbar content -->
        <?php loadPartials('navBar', $user); ?>
        <!-- Header content -->
        <header>
            <img class="logo d-block mx-auto" src="<?= WEBROOT ?>img/logo.png" alt="">
            <?php loadPartials('logMessage'); ?>
        </header>

        <main class="container-fluid  pb-5">
        <?= $content ?>
        </main>

        <!-- Footer content -->
        <footer class="m-0">
            <blockquote class="blockquote text-center">
                <p class="mb-0">" La mémoire se perd, mais l'écriture demeure. "</p>
                <div class="blockquote-footer">Citation de l'Orient <cite title="Source Title">L'Orient en maximes et proverbes (1909)</cite></div>
            </blockquote>
        </footer>
    </body>
</html>