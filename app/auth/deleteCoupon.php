<?php

require_once __DIR__ . '/../../include/db.php';
$id = intval($productId);
$sql = 'DELETE FROM coupon WHERE id=:id';
$statement = $pdo->prepare($sql);
if ($statement->execute([':id' => $id])) {
    header("Location: /addCoupon");
}
