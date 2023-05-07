<?php 

    //cette constante nous renvoie le chemin vers le dossier des views
    define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

    //cette constante va nous ramenez vers le dossiers des fichiers css et javascript
    define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

    //ces constante nous permet de se connecter à la base de donnée
    define('DB_NAME', 'mvcapp');
    define('DB_HOST', '127.0.0.1');
    define('DB_USER', 'root');
    define('DB_PWD', 'winner');
