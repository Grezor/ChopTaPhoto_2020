<?php

header('Acess-Control-Allow-Origin: *');
header('Content-type: application/json');

include_once('../../api/database.php');
include_once('../../api/models/Category.php');

$database = new Database();
$db = $database->Connection();

$category = new Category($db);
$result = $category->read();



if ($result) {
    $category_array = [];
    $category_array['data'] = [];
    $category_count['numbers'] = [];
    $count = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $category_item = [
            'id' => $id,
            'name' => $name,
        ];
        array_push($category_array['data'], $category_item);
    }
    echo json_encode($category_array);
} else {
    // no product
    echo json_encode([
        'message' => 'no category'
    ]);
}
