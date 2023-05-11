<?php 

    namespace App\Models;

    use Database\DbConnection;

    abstract class Model{
        protected $db;
        protected $table;

        public function __construct(DbConnection $db)
        {
            $this->db = $db;
        }

        /**
         * * cette method recupère tous enregistrement dans une table
         * @param void
         * @return array
         */
        public function all() : array 
        {
            $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
           return $this->query($query);
            /*$query = $this->db->getPdo()->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
            $query->setFetchMode(\PDO::FETCH_CLASS, get_class($this), [$this->db]);
            return $query->fetchAll();*/
        }

        /**
         * * cette methode recupère un enregistrement dans une table en fonction 
         * * de son identifiant
         * @param int $id
         * @return Model
         */
        public function findById(int $id) : Model
        {
            $query ="SELECT * FROM {$this->table} WHERE id = ?";
            return $this->query($query, $id, true);
            /*$query = $this->db->getPdo()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $query->setFetchMode(\PDO::FETCH_CLASS, get_class($this), [$this->db]);
            $query->execute([$id]);
            return $query->fetch();*/
        }

        /**
         * * cette methode supprime une donnée dans la base de donnée en fonction 
         * * de son identifiant
         * @param int id
         * @return bool
         */
        public function delete(int $id)
        {
            $query = "DELETE FROM {$this->table} WHERE id = ?";
            return $this->query($query, $id);
        }


        /**
         * * cette method va faire un refactoring de nos requetes en un, elle va faire
         * * la requete soit en query ou en prepare en fonction de ce qu'on veut
         * @param string $sql represente notre requete sql
         * @param int $param répresente le parametre de notre requete pour requete avec where, si il est null on fait un requete query sinon on fait une requete préparé
         * @param bool $single réprésente si on veut faire un fetchAll ou fetch donc false pour fetchAll et true pour fetch
         */
        public function query(string $sqlQuery, int $param = null, bool $single = null)
        {
            /**
             * * si $param est null on fait une requete query sinon c'est une requete
             * *preparé
             */
            $method = is_null($param) ? 'query' : 'prepare';

            /**
             * * comme les requetes delete, update et insert ne nous renvoie par
             * * de donnée on va vérifie le type de de requete dans une condition 
             * * avant de l'executer
             */
            if(strpos($sqlQuery, 'INSERT') === 0
            || strpos($sqlQuery, 'UPDATE') === 0
            || strpos($sqlQuery, 'DELETE') === 0 ) :

             $query = $this->db->getPdo()->$method($sqlQuery);
             $query->setFetchMode(\PDO::FETCH_CLASS, get_class($this), [$this->db]);
             return $query->execute([$param]);

            endif;


            /**
             * * si single est null on fait un fetchAll sinon on fait un fetch
             */
            $fetch = is_null($single) ? 'fetchAll' : 'fetch';

            $query = $this->db->getPdo()->$method($sqlQuery);
            $query->setFetchMode(\PDO::FETCH_CLASS, get_class($this), [$this->db]);

            if($method === 'query') :
             return $query->$fetch();
             else :
                $query->execute([$param]);
                return $query->$fetch();
            endif;
        }
    }