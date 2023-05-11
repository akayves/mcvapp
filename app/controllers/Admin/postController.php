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