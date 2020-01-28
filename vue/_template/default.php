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
        <?php loadPartials('navBar'); ?>
        <!-- Header content -->
        <header>
        </header>

        <!-- Navbar content -->

        <?php loadPartials('logMessage'); ?>
        <main class="container-fluid">
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