<?php

session_start();

function connect() {
    $_SESSION['auth'] = 'toto';
}

function isLogged() {}

function isAdmin() {}

// Test unitaire

function assertTrue($condition)
{
    if (!$condition) {
        throw new Exception('Assert is not true');
    }
}

function assertFalse($condition)
{
    if ($condition) {
        throw new Exception('Assert is not false');
    }
}

function test_connection_user_into_session()
{
    assertFalse(isset($_SESSION['auth']));

    connect();
    assertTrue(isset($_SESSION['auth']));

    unset($_SESSION['auth']);
}

function test_disconnection_user_into_session()
{
    connect();
    assertTrue(isset($_SESSION['auth']));

    unset($_SESSION['auth']);
    assertFalse(isset($_SESSION['auth']));
}

function run() {
    test_connection_user_into_session();
    test_disconnection_user_into_session();
}

try {
    run();
} catch (Exception $e) {
    var_dump($e->getMessage(), $e->getTraceAsString());
}
