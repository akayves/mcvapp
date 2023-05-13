<?php 

    namespace App\Models;
    use DateTime;

    class Post extends Model{

    protected $table = 'posts';

    /**
     * * cette methode permet de formater la colonne created_at en date local
     * @param void
     * @return string
     */
    public function getCreatedAt() : string
    {
        //date_default_timezone_set('Africa/Abidjan');
        return (new DateTime($this->created_at))->format('d/m/Y à h:i');
    }

    /**
     * *cette method va extrait une petite partie de l'article
     * @param void
     * @return string
     */
    public function getExcerpt() : string
    {
        return substr($this->content, 0, 250) . ' ...';   
    }

    /**
     * *cette methode va générer un button html
     * @param void
     * @return string
     */
    public function getButton()
    {
        return <<<html
        <a class="btn btn-primary" href="/posts/$this->id">lire l'article</a>
html;
    }

    /**
     * * cette method récupère les tags liés au sujets
     */
    public function getTags()
    {
        $query ="SELECT t.* FROM tags as t
        INNER JOIN post_tag as pt 
        ON pt.tag_id = t.id
        WHERE pt.post_id = ? ";
        return $this->query($query, [$this->id]); 
    }

    /**
     * * cette methode permet de faire un enregistrement d'un nouvel article
     * @param array data tableaux contenant les onnée à enregistrer
     * @param array relations tableaux content les tags pour le model posrt
     * @return bool
     */
    public function create(array $data, ?array $relations = null)
    {
        parent::create($data);
        $id = $this->db->getPdo()->lastInsertId();

        foreach ($relations as $tagId) {
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$id, $tagId]);
        }

        return true;
    }

    /**
     * * cette methode met à jour le model post et tags
     * @param int id l'identifiant du post à modifier
     * @param array data les tableaux des données
     * @param array relations les tags lié au post
     * @return bool 
     */
    public function update(int $id, array $data, ?array $relations = null)
    {
        parent::update($id, $data);

        $stmt = $this->db->getPDO()->prepare("DELETE FROM post_tag WHERE post_id = ?");
        $result = $stmt->execute([$id]);

        foreach ($relations as $tagId) {
            $stmt = $this->db->getPDO()->prepare("INSERT post_tag (post_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$id, $tagId]);
        }

        if ($result) {
            return true;
        }

    }

}