<?php

namespace app\models;

class Category
{



    private $connexion;
    private $table = 'category';
    public $id;
    public $name;
    public function __construct($db)
    {
        $this->connexion = $db;
    }

    public function read()
    {
        $requete = 'SELECT id,name FROM ' . $this->table ;
        $stmt = $this->connexion->prepare($requete);
        $stmt->execute();
        return $stmt;
    }
}
