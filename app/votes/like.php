<?php 
require_once __DIR__ . '/../../include/db.php';

// on veux apeler le fichier en post
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    http_response_code(403);
    die();
}
// on peut voter pour ce type de contenu
$accepted_refs = ['product'];
if(in_array($_POST['ref'], $accepted_refs)){
    http_response_code(403);
    die();
}
session_start();


// déclanche le votee

require_once __DIR__ . '/../../include/vote.php';
$vote = new Vote($pdo);

if ($_GET['vote'] == 1 ) {
    $vote->like($_POST['ref'], $_POST['ref_id'], $_SESSION['auth']->id);
}else{
    $vote->dislike($_POST['ref'], $_POST['ref_id'], $_SESSION['auth']->id);
}
$req = $pdo->prepare("SELECT like_count, dislike_count FROM {$_POST['ref']} WHERE id= ?");
$req->execute([$_POST['ref_id']]);
die(json_encode($req->fetch(PDO::FETCH_CLASS)));

// header('Location: /produit/' . $_GET['id'] );