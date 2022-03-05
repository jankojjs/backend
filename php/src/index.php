<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

function json($status, $data)
{
    $cors = "*";
    header("Access-Control-Allow-Origin: $cors");
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($status);
    echo json_encode($data);
}

$user = new \JJS\User\User();
$router = new \Bramus\Router\Router();
$user_controller = new \JJS\User\UserController($router, $user);
$router->run();
