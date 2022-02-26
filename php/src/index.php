<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/config/config.php');

$container = $containerBuilder->build();

function json($status, $data)
{
    $cors = "*";
    header("Access-Control-Allow-Origin: $cors");
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($status);
    echo json_encode($data);
}

$conn = $container->get('Db');
$router = $container->get('InnerRouter');
$router->addBaseRoutes();
$router->run();
