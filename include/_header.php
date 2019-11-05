<?php 

require_once '../Ecommerce_Bootstrap/include/header.php';
require_once '../Ecommerce_Bootstrap/include/db.php';
require_once 'include/panier.class.php';
$DB = new DB();
$panier = new Panier($DB);