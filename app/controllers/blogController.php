<?php 

namespace App\Controllers;

use App\Models\Post;

/**
 * * cette class permet de gerer les blog, elle va ettendre la class parent controller
 * * pour faire les actions qui lui sont propre
 */
class blogController extends Controller{

    /**
     * * cette fonction renvoie une vue de l'accueil du blog
     * @param void
     * @return une page de vue
     */
    public function welcome()
    {
        /**
         * * il faut noter que blog.index répresente blog/index.php dans notre dossier views
         */
       return $this->view('blog.welcome');
    }

    /**
     * * cette methode affiches tous les articles
     * @param void
     * @return une page qui contient tous les articles
     */
    public function index()
    {
        /**
         * * post ici est un model qui faire reference à la table post de la base de
         * * donnéé
         */
        $post = new Post($this->getDB());
        $posts = $post->all();

        /**
         * * on va envoyer la variable posts à notre vue pour qu'on puisse l'utiliser pour
         * * afficher ce qu'il contient
         * * notre variable posts est stocké dans compact
         */

        return $this->view('blog.index', compact('posts'));
        
    }
    /**
     * * cette methode affiche un article en fonction de son identifiant
     * @param id
     * @return une page qui contient un article particulier
     */
    public function show(int $id)
    {
        
        $post = new Post($this->getDB());
        $post = $post->findById($id);
        
        /**
         * * il faut noter que blog.show répresente blog/show.php dans notre dossier views
         */
        return $this->view('blog.show', compact('post'));
    }
}