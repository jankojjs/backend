<?php

/**
 * @author      Janko Stanic <jjsolutions034@gmail.com>
 * @copyright   Copyright (c), 2022 Janko Stanic
 * @license     MIT public license
 */

namespace Db;

class Db
{
    public function __construct()
    {
        $root_password = $_ENV['MYSQL_ROOT_PASSWORD'];

        $connectionParams = array(
            'dbname' => 'activetask',
            'user' => 'root',
            'password' => $root_password,
            'host' => 'localhost',
            'driver' => 'mysqli',
        );

        $this->conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    }
}
