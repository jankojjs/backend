<?php

$connectionParams = array(
    'dbname' => 'activetask',
    'user' => 'root',
    'password' => 'MYSQL_ROOT_PASSWORD',
    'host' => 'localhost',
    'driver' => 'mysqli',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
if($conn) {
    echo "success";
}
