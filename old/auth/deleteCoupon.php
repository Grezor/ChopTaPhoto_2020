<?php

require_once __DIR__ . '/../../database/db.php';
$id = intval($productId);
$sql = 'DELETE FROM coupon WHERE id=:id';
$statement = $pdo->prepare($sql);
if ($statement->execute([':id' => $id])) {
    header("Location: /addCoupon");
}
