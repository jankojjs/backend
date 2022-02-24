<?php

$root_password = $_ENV['MYSQL_ROOT_PASSWORD'];

$connectionParams = array(
    'dbname' => 'activetask',
    'user' => 'root',
    'password' => $root_password,
    'host' => 'localhost',
    'driver' => 'mysqli',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
if($conn) {
    echo "success";
}
