<?php 

namespace App\Controllers;

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
    public function index()
    {
        /**
         * * il faut noter que blog.index répresente blog/index.php dans notre dossier views
         */
       return $this->view('blog.index');
    }

    /**
     * * cette methode affiche un article en fonction de son identifiant
     * @param id
     * @return une page qui contient un article particulier
     */
    public function show(int $id)
    {
        /**
         * * il faut noter que blog.show répresente blog/show.php dans notre dossier views
         */
        $query = $this->db->getPdo()->query('SELECT * FROM posts');
        $posts = $query->fetchAll();
        foreach($posts as $post):
            echo $post->title . '<br>';
        endforeach;
        return $this->view('blog.show', compact('id'));
    }
}