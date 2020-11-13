<?php

header('Acess-Control-Allow-Origin: *');
header('Content-type: application/json');

include_once('../../api/database.php');
include_once('../../api/models/Product.php');

$database = new Database();
$db = $database->Connection();

$product = new Product($db);
$result = $product->read();



if ($result) {
    $product_array = [];
    $product_array['data'] = [];
    $product_count['numbers'] = [];
    $count = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $product_item = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'descriptionDetails' => $descriptionDetails,
            'price' => $price,
            'quantity' => $quantity,
            'color' => $color,
            'ref' => $ref, 
            'is_location' => $is_location,
            'category_id' => $category_id,
            'created_at' => $created_at,
            'updated' => $updated
        ];
        array_push($product_array['data'], $product_item);
    }
    // turn to json
    echo count($product_array['data']);
    echo json_encode($product_array);
} else {
    // no product
    echo json_encode([
        'message' => 'no product'
    ]);
}
