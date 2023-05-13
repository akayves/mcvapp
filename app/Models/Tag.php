<?php
namespace App\Models;

class Tag extends Model {
    protected $table ='tags';

        /**
     * * cette methode récupère tous les posts lié aux id
     * @param void
     * @return model renvoie une collection de donnée des posts en fonction des tags
     */
    public function getPosts()
    {
        $query = "SELECT p.* FROM posts as p
                INNER JOIN post_tag as pt
                ON pt.post_id = p.id
                WHERE pt.tag_id = ?";
        return $this->query($query, [$this->id]);
    }
}

    


