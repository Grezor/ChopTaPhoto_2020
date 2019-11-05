<?php 

class Panier{
    
    private $DB;
    public function __construct($DB)
    {
        //si il n'y a pas de sessions
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }
        $this->DB = $DB;
        if (isset($_GET['delPanier'])) {
            $this->del($_GET['delPanier']);
        }
    }

    /**
     * Nombre d'elements dans le panier
     */
    public function countPanier(){
        return array_sum($_SESSION['panier']);
    }

    /**
     * 
     */
    public function total(){
        
        $total = 0;
        $ids = array_keys($_SESSION['panier']);
        if (empty($ids)) {
            $products = [];
        } else {
            $products = $this->DB->query('SELECT id, price FROM products WHERE id IN (' . implode(',', $ids) . ')');
        } 
        foreach($products as $product){
            $total += $product['price'] * $_SESSION['panier'][$product['id']];
        }
        return $total;
    }

    public function add($product_id){
        // est ce que dans le panier il y a deja le produit ajouter
        if (isset($_SESSION['panier'][$product_id])) {
            $_SESSION['panier'][$product_id]++;
        }else{
            $_SESSION['panier'][$product_id] = 1;
        }
        
        
    }

    public function del($product_id){
        unset($_SESSION['panier'][$product_id]);
    }

    
}