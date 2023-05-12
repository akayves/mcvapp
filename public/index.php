<?php 

use Router\Router;
use App\Exceptions\NotFoundException;

require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/constants.php';

$router = new Router($_GET['url']);

/**
 * * frontend route
 */

/**
 * en plus de $router->get() on pourrait faire aussi créer des router post method
 */
$router->get('/', 'App\Controllers\blogController@welcome');
$router->get('/posts', 'App\Controllers\blogController@index');
//on peut changer posts en ce qu'on veut en cas de réutilisation
$router->get('posts/:id', 'App\Controllers\blogController@show');
$router->get('/tags/:id', 'App\Controllers\blogController@tag');

/**
 * * admin route
 */
$router->get('/admin/posts', 'App\Controllers\Admin\postController@index');
$router->post('/admin/posts/delete/:id', 'App\Controllers\Admin\postController@destroy');
$router->get("/admin/posts/edit/:id", 'App\Controllers\Admin\postController@edit');
$router->post("/admin/posts/edit/:id", 'App\Controllers\Admin\postController@update');

/**
 * * il vérifie si nos route fonctionne normalement sinon envoie une erreur 404
 */
try{
    $router->run(); 
}catch(NotFoundException $e) {
    return $e->error404();
}


    