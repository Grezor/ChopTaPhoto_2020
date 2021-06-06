<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;

$router->get('/', [HomeController::class, 'index'], 'home');

$router->get('/login', [AuthController::class, 'showLogin'], 'auth.login');
$router->post('/login', [AuthController::class, 'login'], null);
