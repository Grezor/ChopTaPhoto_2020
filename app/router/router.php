<?php

$uri = $_SERVER['REQUEST_URI'];

function pageNotFound($msg = 'Page introuvable') {
    header('HTTP/1.1 404 Not Found', true, 404);
    echo $msg;
}

$router = new AltoRouter();

define('VIEW_PATH', realpath(__DIR__ . '/../'));

$router->map('GET', '/produit', function() {
    echo 'dddddd';
});

$router->map('GET', '/produit/[i:id]', function($productId) {
    // echo 'je suis ' . $lol;
    require VIEW_PATH . '/productDetails.php';
}, 'product.show');

$router->map('GET | POST', '/login', function() {
    require VIEW_PATH . '/auth/login.php';
}, 'login');

$router->map('GET | POST', '/register', function() {
    require VIEW_PATH . '/auth/register.php';
}, 'register');

$router->map('GET', '/logout', function() {
    require VIEW_PATH . '/auth/logout.php';
}, 'logout');


$router->map('GET', '/confirm', function() {
    require VIEW_PATH . '/auth/confirm.php';
}, 'confirm');

$router->map('GET | POST', '/forget', function() {
    require VIEW_PATH . '/auth/forget.php';
}, 'forget');

$router->map('GET | POST', '/booking', function() {
    require VIEW_PATH . '/booking/booking.php';
}, 'booking');

$router->map('GET | POST', '/authbooking', function() {
    require VIEW_PATH . '/auth/booking.php';
}, 'authbooking');

// $router->map('GET | POST', '/reservations/[i:id]', function() {
//     require VIEW_PATH . '/booking/reservations.php';
// }, 'reservations');
/*
call create_range_date('2020-01-21', '2020-01-30', 1, 'DAY');
select max(q.nb) as m, q.t from (
    select count(*) as nb, interval_start as t from booking, time_intervals
	where interval_start between booking.debut and booking.fin
	group by interval_start
) as q;
*/

$router->map('GET | POST', '/reset', function() {
    require VIEW_PATH . '/auth/reset.php';
}, 'reset');

$router->map('GET | POST', '/account', function() {
    require VIEW_PATH . '/auth/account.php';
}, 'account');

$router->map('GET | POST', '/addProduct', function() {
    require VIEW_PATH . '/auth/addProduct.php';
}, 'addProduct');

$router->map('GET | POST', '/addCoupon', function() {
    require VIEW_PATH . '/auth/addCoupon.php';
}, 'addCoupon');

$router->map('GET | POST', '/allUsers', function() {
    require VIEW_PATH . '/auth/allUsers.php';
}, 'allUsers');


$router->map('GET | POST', '/edit', function() {
    require VIEW_PATH . '/auth/edit.php';
}, 'edit');



$router->map('GET | POST', '/delete', function() {
    require VIEW_PATH . '/auth/delete.php';
}, 'delete');

$router->map('GET', '/admin', function() {
    require VIEW_PATH . '/auth/admin.php';
}, 'admin');

$router->map('GET', '/', function() {
    require VIEW_PATH . '/products.php';
}, 'home');
$match = $router->match();
if ($match === false) {
    $match = [
        'target' => 'pageNotFound',
        'name' => '',
        'params' => []
    ];
}

// var_dump($router->generate('produit.show', ['id' => 1]));
call_user_func_array($match['target'], $match['params']);