<?php 
class Product {
    private $connexion;
    private $table = 'product';
    
    public $id;
    public $name; 
    public $description;
    public $descriptionDetails;
    public $price;
    public $quantity;
    public $color;
    public $ref;
    public $is_location;
    public $category_id;
    public $created_at;
    public $updated;

    public function __construct($db)
    {
        $this->connexion = $db;
    }

    public function read()
    {
        $requete = 'SELECT id,name, description, descriptionDetails, price, quantity, color, ref, is_location, category_id, created_at, updated 
                    FROM ' . $this->table . ' ORDER BY created_at';
        $stmt = $this->connexion->prepare($requete);
        $stmt->execute();
        return $stmt;
    }
}