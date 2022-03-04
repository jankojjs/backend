<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$db = new \JJS\Db\Db($_ENV['MYSQL_HOST'], $_ENV['MYSQL_ROOT'], $_ENV['MYSQL_ROOT_PASSWORD'], $_ENV['MYSQL_DATABASE']);
$user = new \JJS\User\User($db);

$user->initTable();
