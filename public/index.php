<?php 

    use Router\Router;

    require __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../config/constants.php';

    $router = new Router($_GET['url']);

    /**
     * en plus de $router->get() on pourrait faire aussi créer des router post method
     */
    $router->get('/', 'App\Controllers\blogController@welcome');
    $router->get('/posts', 'App\Controllers\blogController@index');
    //on peut changer posts en ce qu'on veut en cas de réutilisation
    $router->get('posts/:id', 'App\Controllers\blogController@show');
    $router->get('/tags/:id', 'App\Controllers\blogController@tag');

    //il vérifie si nos routes matches normalement
    $router->run(); 