<?php 

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Controllers\Controller;
use App\Models\Tag;

/**
 * * cette class va gérer l'administration de nos posts
 */

 class postController extends Controller{

    /**
     * * cette methode va afficher la liste de tous nos posts
     * @param void
     * @return une page qui liste les posts
     */
    public function index()
    {
        $posts = (new Post($this->getDB()))->all();
        return $this->view('admin.post.index', compact('posts'));
    }
    
    /**
     * * cette methode affiche la vue d'ajout d'article
     * @param void
     * @return un formulaire de création d'un article
     */
    public function create()
    {
        $tags = (new Tag($this->getDB()))->all();
        return $this->view('admin.post.form', compact('tags'));
    }

    /**
     * * cette methode se charge d'enregistrer les donnée du formulaire lors
     * * de la création d'un nouvel article
     * @param
     * @return 
     */
    public function createPost()
    {
        $post = new Post($this->getDB());
        $tags = array_pop($_POST);
        $result = $post->create($_POST, $tags);

        if($result):
            return header("Location: /admin/posts");
        endif;
    }

    /**
     * * cette methode affiche la vue d'un article à modifier
     * @param id
     * @return une vue
     */
    public function edit(int $id)
    {
        $post = (new Post($this->getDB()))->findById($id);
        $tags = (new Tag($this->getDB()))->all();

        return $this->view('admin.post.form', compact('post', 'tags'));
    }

    /**
     * * ce methode enregistre dans la base de donnée un article qu'on modifie
     * @param int id
     * @return un article modifié
     */
    public function update(int $id)
    {
        $post = new Post($this->getDB());
        $tags = array_pop($_POST);
        $result = $post->update($id, $_POST, $tags);

        if($result):
            return header("Location: /admin/posts");
        endif;
    }

    /**
     * * cette methode supprime un post dans la base de données
     * @param int id
     * @return header location 
     */
    public function destroy(int $id)
    {
        $post = new Post($this->getDB());
        $result = $post->delete($id);

        if($result) :
           return header('Location: /admin/posts');
        endif;
    }

 }