<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/autoload.php';

function json($status, $data)
{
    $cors = "*";
    header("Access-Control-Allow-Origin: $cors");
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($status);
    echo json_encode($data);
}

$router = new \Bramus\Router\Router();
$user_controller = new UserController($router);
$router->run();
