<?php 

use Router\Router;

    require __DIR__.'/../vendor/autoload.php';

    $rooter = new Router($_GET['url']);

    $rooter->show();