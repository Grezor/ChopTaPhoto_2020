<?php

namespace app\api\models;

class User
{
    private $connexion;
    private $table = 'client';

    public $id;
    public $name;
    public $firstname;
    public $email;
    public $password;
    public $email_token;
    public $register_at;
    public $connection_at;
    public $reset_token;
    public $reset_at;
    public $role;

    public function __construct($db)
    {
        $this->connexion = $db;
    }

    public function read()
    {
        $requete = 'SELECT id, name, firstname, email, password, email_token, register_at, connection_at, reset_token, 
                        reset_at, role 
                    FROM ' . $this->table . ' ORDER BY register_at';
        $stmt = $this->connexion->prepare($requete);
        $stmt->execute();
        return $stmt;
    }
}
