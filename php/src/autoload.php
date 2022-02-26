<?php

/**
 * @author      Janko Stanic <jjsolutions034@gmail.com>
 * @copyright   Copyright (c), 2022 Janko Stanic
 * @license     MIT public license
 */

function autoloadModel($className)
{
    $filename = __DIR__ . "/models/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}

function autoloadController($className)
{
    $filename = __DIR__ . "/controllers/" . $className . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}

spl_autoload_register("autoloadModel");
spl_autoload_register("autoloadController");
