<?php 
require_once '../Ecommerce_Bootstrap/include/_header.php';
if (isset($_GET['id'])) {
    $product = $DB->query('SELECT id FROM products WHERE id=:id', array('id' =>$_GET['id']));
    // si le produit est vide
    if (empty($product)) {
        die('ce produit n_exite pas');
    }
    $panier->add($product[0]['id']);
    die('produit ajouter');
    //var_dump($product);
}else {
    die('vous n avez rien selectionner');
}
