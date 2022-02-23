<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

use DI\Container;

$container = new Container();
require __DIR__ . '/autoload.php';
require __DIR__ . '/config/index.php';
