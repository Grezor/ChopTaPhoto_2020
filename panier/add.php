<?php 
require_once  __DIR__ . '../../include/_header.php';
ob_start();
if (isset($_GET['id'])) {
    $product = $DB->query('SELECT id FROM product WHERE id=:id', array('id' =>$_GET['id']));
    // si le produit est vide
    if (empty($product)) {
        die('ce produit n_exite pas');
    }
    $panier->add($product[0]->id);
  
    
    exit();
    //var_dump($product);
}else {
    die('vous n avez rien selectionner');
}
