<?php

namespace App\Database;

use PDO;

class Database
{
    private PDO $pdo;

    public function __construct($login, $password, $database_name, $host = 'localhost')
    {
        $this->pdo = new PDO("mysql:dbname=$database_name;host=$host", $login, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    static function getDatabase()
    {
        return new Database('root', '', 'choptaphoto');
    }
    /**
     * Undocumented function
     *
     * @param [type] $query
     * @param bool|array $params
     * 
     */
    public function query($query, $params = false)
    {
        if ($params) {
            $requete = $this->pdo->prepare($query);
            $requete->execute($params);
        } else {
            $requete = $this->pdo->query($query);
        }
        return $requete;
    }
}
