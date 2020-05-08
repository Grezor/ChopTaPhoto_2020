<?php 
require_once  __DIR__ . '/db.php';

$DB = new DB();

date_default_timezone_set('Europe/Paris');

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
/**
 * genere un uuid pour l'image 
 */
function uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
