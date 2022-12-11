<?php

header('Acess-Control-Allow-Origin: *');
header('Content-type: application/json');
include_once('../../api/database.php');
include_once('../../api/models/Booking.php');

$database = new Database();
$db = $database->connection();

$booking = new Booking($db);
$bookings = $booking->read();

$bookingResults = [];
foreach ($bookings as $row) {
    $bookingResults[] = [
        'id' => $row['id'],
        'nom' => $row['nom'],
        'prenom' => $row['prenom'],
        'email' => $row['email'],
        'adresse' => $row['adresse'],
        'postal' => $row['postal'],
        'ville' => $row['ville'],
        'debut' => $row['debut'],
        'fin' => $row['fin'],
        'created_at' => $row['created_at']
    ];
}

if (empty($bookingResults)) {
    // no product
    echo json_encode([
        'message' => 'no booking'
    ]);
    return;
}

echo json_encode([
    'data' => $bookingResults
]);
