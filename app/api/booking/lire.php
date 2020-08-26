<?php

header('Acess-Control-Allow-Origin: *');
header('Content-type: application/json');

include_once('../../api/database.php');
include_once('../../api/models/Booking.php');

$database = new Database();
$db = $database->Connection();

$booking = new Booking($db);

$result = $booking->read();

// get row count
$numbers = $result->rowCount();

if ($numbers > 0) {
    $booking_array = [];
    $booking_array['data'] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $booking_item = [
            'id' => $id,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'adresse' => $adresse,
            'postal' => $postal,
            'ville' => $ville,
            'debut' => $debut, 
            'fin' => $fin,
            'created_at' => $created_at

        ];
        array_push($booking_array['data'], $booking_item);
    }
    // turn to json
    echo json_encode($booking_array);
} else {
    // no product
    echo json_encode([
        'message' => 'no booking'
    ]);
}
