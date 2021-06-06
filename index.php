<?php

use App\Router\Router;

require_once __DIR__ . '/vendor/autoload.php';

$altoRouter = new AltoRouter();
$router = new Router($altoRouter);

require __DIR__ . '/routes/web.php';

$response = $router->run();
$response->render();
