<?php

header('Acess-Control-Allow-Origin: *');
header('Content-type: application/json');

include_once('../../api/database.php');
include_once('../../api/models/User.php');

$database = new Database();
$db = $database->Connection();

$user = new User($db);

$users = $user->read();

$userResults = [];
foreach ($users as $row) {
    $userResults[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'firstname' => $row['firstname'],
        'email' => $row['email'],
        'password' => $row['password'],
        'email_token' => $row['email_token'],
        'register_at' => $row['register_at'],
        'connection_at' => $row['connection_at'],
        'reset_token' => $row['reset_token'],
        'reset_at' => $row['reset_at'],
        'role' => $row['role'],
        
    ];
}

if (empty($userResults)) {
    // no product
    echo json_encode([
        'message' => 'no users'
    ]);
    return;
}

// turn to json
echo json_encode([
    'data' => $userResults
]);
