<?php 
require_once  __DIR__ . '/db.php';

$DB = new DB();


function sessionStart() {
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
}

function countCategories(){
    $countCategories = $this->DB->prepare('SELECT count(*) FROM category');
    $countCategories->execute([]);
}

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

function logged_only(){
    if(!isset($_SESSION['auth'])){
        $_SESSION['flash']['danger'] = " Vous n'avez pas le droit d'accéder a cette page";
        header('Location: login.php');
        exit();
    }
}
function isAdmin($user): bool {
    
    return (int) $user->role === 1;
}