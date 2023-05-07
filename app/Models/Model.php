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
            $query = $this->db->getPdo()->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
            return $query->fetchAll();
        }

        /**
         * * cette methode recupère un enregistrement dans une table en fonction 
         * * de son identifiant
         * @param int $id
         * @return stdclass
         */
        public function findById(int $id)
        {
            $query = $this->db->getPdo()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $query->execute([$id]);

            return $query->fetch();
        }
    }