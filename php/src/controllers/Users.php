<?php

/**
 * @author      Janko Stanic <jjsolutions034@gmail.com>
 * @copyright   Copyright (c), 2022 Janko Stanic
 * @license     MIT public license
 */
// namespace Janko\Users;
class Users
{
    public $router;

    public function add($router)
    {
        $this->router = $router;
        $this->router->mount('/users', function() use ($router) {
            // will result in '/users/'
            $router->get('/', function() {
                echo 'list all users';
            });
        
            // will result in '/users/id'
            $router->get('/(\d+)', function($id) {
                echo 'user id ' . htmlentities($id);
            });

        });
    }
}

return [
    Users::class => DI\factory([FooFactory::class, 'add']),
];