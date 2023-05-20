<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= SCRIPTS . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'app.css';?>">
    <script defer src="<?= SCRIPTS . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'app.js';?>"></script>
    <title>Mon super site</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts">Les derniers articles</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['auth'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Se deconnecter</a> 
                </li>
               <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Se connecter</a> 
                </li>
                <?php endif; ?>
            </ul>           
        </div>
    </nav>
    <!--
        content ici est comme le required de blog.index ou blog.show ou tout autre fichier
    -->
    <div class="container">
        <?= $content?>
    </div>
    
</body>
</html>