<?php

use App\Class\Session;
use App\Controllers\AuthController;
use App\Database\Database;
use App\Entities\User;
use App\Responses\HttpResponse;

$db = Database::getDatabase();
$auth = new AuthController();

if ($auth->confirmEmail($db, $_GET['id'], $_GET['token'], Session::getInstance())) {
    Session::getInstance()->messageFlash('success',"Votre compte a bien étais validé");
    return new HttpResponse(200, 'front/login', 'account', []);
} else {
    Session::getInstance()->messageFlash('danger',"ce token n'est plus valide");
    $response = new HttpResponse(200, 'front/register', 'register', []);
    return $response;
}
