<?php
require_once("database/database.php");

function afficher()
{
    require_once './database/database.php';
    $req = $pdo->prepare("SELECT * FROM product");
    $req->execute();
    $data = $req->fetchAll();
}


function ajouter($name, $description, $price, $quantity, $ref, $category_id, $is_location, $created_at)
{
    $req = $pdo->prepare("INSERT INTO product (
        name, description, price, quantity, ref, category_id, is_location, created_at)
        VALUES(:name, :description, :price, :quantity, :ref, :category_id, :is_location, now())
    ");
    $req->execute([
        ':name' => $_POST['name'],
        ':description' => $_POST['description'],
        ':price' => (int) $_POST['price'],
        ':quantity' => $_POST['quantity'],
        ':category_id' => $_POST['category_id'],
        ':ref' => $_POST['ref'],
        ':is_location' => (int) $location
    ]);
}

function supprimer()
{

}