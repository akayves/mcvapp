<?php 
/**
 * cette class va permettre de stocker nos routes et les actions
 */
namespace Router;

use Database\DbConnection;

 class Route{
    public $path;
    public $action;
    public $matches;

    public function __construct( $path,  $action) {
        $this->path = trim($path, '/');
        $this->action = $action;        
    }

    /**
     * *cette methode faire correspondre la bonne url en cas de modification par l'utilisateur 
     * @param string url
     * @return bool
     */
    public function matches(string $url) 
    {
        $path = preg_replace("#:([\w]+)#", "([^/]+)", $this->path);
        $pathToMatch = "#^$path$#";

        /**si le path est bon on va utilisé preg_match pour la vérification*/
        if(preg_match($pathToMatch, $url, $matches)) : 
            $this->matches = $matches;
            return true;
        else :
            return false;
        endif;
    }
    
    /**
     * *cette methode permet d'éxecuter nos actions
     * @param void
     * @return il renvoie une method
     */
    public function execute() 
    {
        /* on récupère notre action avec fonctions explode ensuite on créer une instance de la class blogController
        nb : on a mis explode de @ parceque dans notre routes nous avons utilisé
        @ comme la liaison entre la class et l'action ex blogController@index
         */
        $params = explode('@', $this->action);

        //crée une nouvelle instance d'unController
        $controller = new $params[0](new DbConnection(DB_NAME, DB_HOST, DB_USER, DB_PWD));
        $method = $params[1]; // récupère notre action ou method

        /* on va utiliser une ternaire pour vérifier si la pages envoyé est avec un identifiant sinon on renvoie une page sans parametre url*/
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method();
    }
 }