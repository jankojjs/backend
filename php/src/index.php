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

$db = new \JJS\Db\Db($_ENV['MYSQL_HOST'], $_ENV['MYSQL_ROOT'], $_ENV['MYSQL_ROOT_PASSWORD'], $_ENV['MYSQL_DATABASE']);
$user = new \JJS\User\User($db);
$router = new \Bramus\Router\Router();
$user_controller = new \JJS\User\UserController($router, $user);
$router->run();
