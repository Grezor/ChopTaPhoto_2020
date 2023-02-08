<?php

/**
 * Session start
 */
function sessionStart()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

/**
 * Generate random id
 */
function randomId()
{
    $string = rand(0, 9);
    $string = strval($string);
    $chaine = "abcdefghijklmnpqrstuvwxy";
    srand((double)microtime() * 1000000);
    for ($i = 0; $i < 2; $i++) {
        $string .= $chaine[rand() % strlen($chaine)];
    }
    return $string;
}

function pageNotFound($msg = 'Page introuvable 2')
{
    header('HTTP/1.1 404 Not Found', true, 404);
    echo $msg;
}
/**
 * generates a token key to register
 */
function str_random($length)
{
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

/**
 * the user must log in before accessing the desired page
 */
function logged_only()
{
    if (!isset($_SESSION['auth'])) {
        $_SESSION['flash']['danger'] = " Vous n'avez pas le droit d'accéder a cette page";
        header('Location: login.php');
        exit();
    }
}

/**
 * Allows to know if the user has an admin role
 */
function isAdmin($user): bool
{
    return (int) $user->role === 1;
}

/**
 * this function is not used ?
 */
function get_orders_with()
{
    require_once '../../database/db.php';
    $req = $pdo->prepare('SELECT id FROM product WHERE name = ?');
    $req->execute([$_POST['name']]);
}

function defineView()
{
    return define('VIEW_PATH', realpath(__DIR__ . '/../'));
}
