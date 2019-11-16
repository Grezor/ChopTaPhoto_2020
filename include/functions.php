<?php 
require_once  __DIR__ . '/db.php';

$DB = new DB();


function randomId() {
    //fonction qui génére un id aléatoire
    $string = rand(0,9);
    $string = strval($string);
    $chaine = "abcdefghijklmnpqrstuvwxy";
    srand((double)microtime()*1000000);
    for($i=0; $i<2; $i++) {
        $string .= $chaine[rand()%strlen($chaine)];
    }
    return $string;
}

function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}