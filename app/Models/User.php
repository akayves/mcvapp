<?php 

namespace App\Models;

/**
 * * cette va gerer le model user en base de donnée
 */
class User extends Model{
    
    protected $table ="users";

    /**
     * * cette methode permet de récuperer un utilisateur par son nom utilisateur
     * @param string username
     * @return model user
     */
    public function getByUsername(string $username) : User
    {
        $query = "SELECT * FROM {$this->table} WHERE username = ?";
        return $this->query($query, [$username], true);
    }
}