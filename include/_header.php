<?php

require_once  __DIR__ . '/header.php';
require_once  __DIR__ . '/db.php';
require_once  __DIR__ . '/panier.class.php';
$DB = new DB();
$panier = new Panier($DB);
