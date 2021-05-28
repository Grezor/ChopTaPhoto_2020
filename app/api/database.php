<?php

namespace  App\api;

class Database
{
    // Connexion à la base de données
    private $host = "localhost";
    private $db_name = "choptaphoto";
    private $username = "root";
    private $password = "";
    private $connexion;

    // getter pour la connexion
    public function connection()
    {

        $this->connexion = null;

        try {
            $this->connexion = new PDO(
                "mysql:host=" . $this->host . ";
                dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->connexion->exec("set names utf8");
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->connexion;
    }
}
