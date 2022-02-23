<?php
require __DIR__ . '/../controllers/Users.php';
// Create Router instance

// use Janko\Users\Users;

$router = new \Bramus\Router\Router();

// Define routes
$router->get('/about', function() {
    echo 'About Page Contents';
});

$router->get('/hello/(\w+)', function($name) {
    echo 'Hello ' . htmlentities($name);
});

$router->get('/login/(\w+)', function($user) {
    json(200, [
        "status" => 200,
        "message" => "action completed successfully",
        "id" => 44236,
        "name" => $user,
    ]);
});

$janko = new Users($router);
// Run it!
$router->run();
