<?php 
namespace Database;

class DbConnection{
    private $dbname;
    private $host;
    private $username;
    private $password;
    private $pdo;

    public function __construct(string $dbname, string $host, string $username, string $password)
    {
        $this->dbname = $dbname;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * * cette method permet de se connecter à la base de donnée
     * @param void
     * @return PDO instance
     */
    public function getPdo() : \PDO
    {
        return $this->pdo ?? $this->pdo = new \PDO("mysql:dbname={$this->dbname};host={$this->host}", $this->username, $this->password, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            //PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER UTF8'
        ]);
    }
}