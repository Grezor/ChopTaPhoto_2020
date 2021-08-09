<?php

use App\Class\Session;
use App\Controllers\AuthController;

$auth = new AuthController();
$auth->restriction(Session::getInstance());