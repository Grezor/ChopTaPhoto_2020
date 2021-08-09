<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Entities\User;

$router->get('/', [HomeController::class, 'index'], 'home');

$router->get('/login', [AuthController::class, 'showLogin'], 'auth.login');
$router->post('/login', [AuthController::class, 'login'], null);

$router->get('/register', [AuthController::class, 'showRegister'], 'auth.register');
$router->post('/register', [AuthController::class, 'register'], 'register');

$router->get('/confirm/[:id]/[:token]', [AuthController::class, 'confirmEmail'], 'auth.confirm');
