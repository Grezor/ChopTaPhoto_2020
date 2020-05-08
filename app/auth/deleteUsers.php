<?php
require_once __DIR__ .'/../../include/db.php';
$id = intval($userId);
$sql = 'DELETE FROM client WHERE id=:id';
$statement = $pdo->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location: /allUsers");
}