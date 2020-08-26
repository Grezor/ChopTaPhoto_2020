<?php 
class Booking {
    private $connexion;
    private $table = 'booking';
    
    public $id;
    public $nom; 
    public $prenom;
    public $email;
    public $adresse;
    public $postal;
    public $ville;
    public $debut;
    public $fin;
    public $created_at;

    public function __construct($db)
    {
        $this->connexion = $db;
    }

    public function read()
    {
        $requete = 'SELECT id, nom, prenom, email, adresse, postal, ville, debut, fin, created_at FROM ' . $this->table . ' ORDER BY created_at';
        $stmt = $this->connexion->prepare($requete);
        $stmt->execute();
        return $stmt;
    }
}