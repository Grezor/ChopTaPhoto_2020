<?php

require_once __DIR__ .'/../../include/db.php';
$id = $_GET['id'];
$sql = 'DELETE FROM product WHERE id=:id';
$statement = $pdo->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location: /addProduct");
}