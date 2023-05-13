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
            return $this->query($query, [$id], true);
        }

        /**
         * * cette methode permet de faire des enregistrement classique dans
         * * la base de donnée
         * @param array data tableau de donnée
         * @param array relation les relations manyToMany qu'on fait
         * @return bool 
         */
        public function create(array $data, ?array $relations = null)
        {
            $firstParenthesis =""; //première parenthèse
            $secondParenthesis =""; //deuxième parenthèse
            $i = 1;
            foreach ($data as $key => $value) {
                $comma = $i === count($data) ? "" : ", ";
                $firstParenthesis .= "{$key}{$comma}";
                $secondParenthesis .= ":{$key}{$comma}";
                $i++;
            }
            
            return $this->query("INSERT INTO {$this->table} ($firstParenthesis) VALUES ($secondParenthesis)", $data);
        }

        /**
         * * cette methode permet de faire un mis à jour classique
         * * en base de donnée
         * @param int id
         * @param array data
         * @return bool
         */
        public function update(int $id, array $data, ?array $relations = null)
        {
            $i = 1;
            $sqlRequestPart ="";

            foreach ($data as $key => $value) {
                $comma = $i === count($data) ? "" : ", ";
                $sqlRequestPart .= "{$key} = :{$key}{$comma}";
                $i++;
            }
            $data['id'] = $id;
            return $this->query("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id = :id", $data);
           
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
            return $this->query($query, [$id]);
        }


        /**
         * * cette method va faire un refactoring de nos requetes en un, elle va faire
         * * la requete soit en query ou en prepare en fonction de ce qu'on veut
         * @param string $sql represente notre requete sql
         * @param int $param répresente le parametre de notre requete pour requete avec where, si il est null on fait un requete query sinon on fait une requete préparé
         * @param bool $single réprésente si on veut faire un fetchAll ou fetch donc false pour fetchAll et true pour fetch
         */
        public function query(string $sqlQuery, array $param = null, bool $single = null)
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
             return $query->execute($param);

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
                $query->execute($param);
                return $query->$fetch();
            endif;
        }
    }