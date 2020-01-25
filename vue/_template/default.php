<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $_SESSION['title'] ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="<?= WEBROOT ?>css/bootstrap.css">
        <link rel="stylesheet" href="<?= WEBROOT ?>css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    </head>
        
    <body>

        <!-- Header content -->
        <header>

        </header>

        <!-- Navbar content -->
        <?php loadPartials('navBar'); ?>
        
        <main class="container-fluid">

        <?php loadPartials('logMessage'); ?>

        <?= $content ?>
        </main>

        <!-- Footer content -->
        <footer>
        </footer>
    </body>
</html>