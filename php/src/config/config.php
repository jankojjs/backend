<?php

require_once __DIR__ . '/Db.php';
require_once __DIR__ . '/Router.php';

use Db\Db;
use InnerRouter\InnerRouter;
use Bramus\Router\Router;
use function DI\create;

return [
    'Db' => create(Db::class),
    'InnerRouter' => create(InnerRouter::class),
    'BramusRouter' => create(Router::class),
];
