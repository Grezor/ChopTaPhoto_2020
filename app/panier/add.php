<?php 
// require_once  __DIR__ . '../../include/_header.php';
// ob_start();
// if (isset($_GET['id'])) {
//     $product = $DB->query('SELECT id FROM product WHERE id=:id', array('id' =>$_GET['id']));
//     // si le produit est vide
//     if (empty($product)) {
//         die('ce produit n_exite pas');
//     }
//     $panier->add($product[0]->id);
  
//     header('Location: manage.php');
//     exit();
//     //var_dump($product);
// }else {
//     die('vous n avez rien selectionner');
// }

// require_once '../Ecommerce_Bootstrap/include/_header.php';
// require_once  '../../include/header.php';
require __DIR__ . '/../../include/_header.php';
if (isset($_GET['id'])) {
    $product = $DB->query('SELECT id FROM product WHERE id=:id', array('id' =>$_GET['id']));
    // si le produit est vide
    if (empty($product)) {
        die('ce produit n_exite pas');
    }
    $panier->add($product[0]->id);
    header('Location: /app/panier/manage.php');
    die('produit ajouter');
    //var_dump($product);
}else {
    die('vous n avez rien selectionner');
}