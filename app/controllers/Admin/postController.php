<?php 

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Controllers\Controller;

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
     * * cette methode affiche la vue d'un article à modifier
     * @param id
     * @return une vue
     */
    public function edit(int $id)
    {
        $post = (new Post($this->getDB()))->findById($id);
        return $this->view('admin.post.edit', compact('post'));
    }

    /**
     * * ce methode enregistre dans la base de donnée un article qu'on modifie
     * @param int id
     * @return un article modifié
     */
    public function update(int $id)
    {
        $post = new Post($this->getDB());
        $result = $post->update($id, $_POST);

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