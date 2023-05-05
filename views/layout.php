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
    <!--
        content ici est comme le required de blog.index ou blog.show ou tout autre fichier
    -->
    <div class="container">
        <?= $content?>
    </div>
    
</body>
</html>