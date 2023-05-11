<?php 

namespace Router;
use App\Exceptions\NotFoundException;


/**
 * cette class va nous permettre de configurer nos routes et les récupérer
 * après sur la page index.php
 */

class Router {
    public $url;
    public $routes = []; //enregistre nos routes

    public function __construct(string $url)
    {
        $this->url = trim($url, '/');
    }

    /**
     * * cette method se charge de traiter nos vue en get 
     * TODO: on peut créer une autre method post pour traiter les requetes en post
     * @param string path, action 
     * @return renvoie l'affichage d'une page
     */
    public function get($path, $action)
    {
        //stock les nos routes
        $this->routes['GET'][] = new Route($path, $action);
    }

    /**
     * * cette method se charge de traiter nos vue post
     * @param string path, action 
     * @return void
     */
    public function post($path, $action)
    {
        //stock les nos routes
        $this->routes['POST'][] = new Route($path, $action);
    }

    /**
     * * cette method se charge d'executer correctement le type de method get/post
     * @param void
     * @return une pass d'erreur 404 si l'url n'existe pas
     */
    public function run()
    {
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) :
            if($route->matches($this->url)) :
                return $route->execute();
            endif; 
        endforeach;

        // si l'url ne fonctionne pas ou n'existe pas on envoie une ereur 404
        //return header('HTTP/1.0 404 not found');
        throw new NotFoundException('la page demandé est introuvable');
    }

}