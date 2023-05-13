<?php 
 namespace App\Controllers;

use Database\DbConnection;

/**
 * * cette class ecrit la logique pour nos different controller qu'on va créer
 * * elle va etre hérité par chaque controller que nous créer exemple pour le blogController
 * 
 */
abstract class Controller{
   protected $db;
   
   public function __construct(DbConnection $db)
   {
      if(session_status() === PHP_SESSION_NONE) :
         session_start();
      endif;

      $this->db = $db;
   }
   
    /**
     * * cette method va nous permettre d'afficher nos vue des different page, ici
     * * ça peut etre soit une page qui n'a pas besoin d'un id ou une page qui affiche
     * * en fonction de l'id
     * @param string $path le chemin
     * @param array $params qui contiendra l'id
     */
   protected function view(string $path, array $params = null)
   {
      ob_start();
      $path = str_replace('.', DIRECTORY_SEPARATOR, $path);

      require VIEWS . $path . '.php';

      /**
       * * on va mettre ce qu'on a recuperer avec ob_start() dans la variable $content
      */
      $content = ob_get_clean();

      //on require le fichier layout
      require VIEWS . 'layout.php';
   }

   /**
    * * cette methode recupère la connexion à la base de donnée
    * @param void
    * @return la connexion base de donnée
    */
    protected function getDB() 
    {
      return $this->db;
    }

    /**
     * * cette methode vérifie si vous etes un administrateur
     */
    public function isAdmin()
    {
      if( isset($_SESSION['auth']) && $_SESSION['auth'] === 1): 
         return true;
         else :
            return header('Location: /login');
      endif;
    }
    

 }