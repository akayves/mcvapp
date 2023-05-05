<?php 

    use Router\Router;

    require __DIR__.'/../vendor/autoload.php';

    //cette constante nous renvoie le chemin vers le dossier des views
    define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

    //cette constante va nous ramenez vers le dossiers des fichiers css et javascript
    define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

    $router = new Router($_GET['url']);

    /**
     * en plus de $router->get() on pourrait faire aussi créer des router post method
     */
    $router->get('/', 'App\Controllers\blogController@index');

    //on peut changer posts en ce qu'on veut en cas de réutilisation
    $router->get('posts/:id', 'App\Controllers\blogController@show');

    //il vérifie si nos routes matches normalement
    $router->run(); 