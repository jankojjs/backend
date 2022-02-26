<?php

/**
 * @author      Janko Stanic <jjsolutions034@gmail.com>
 * @copyright   Copyright (c), 2022 Janko Stanic
 * @license     MIT public license
 */

namespace InnerRouter;

use Bramus\Router\Router;

class InnerRouter
{
    public function __construct()
    {
        $this->router = new Router();
    }

    public function addBaseRoutes()
    {
        $this->router->get('/about', function () {
            echo 'About Page Contents';
        });

        $this->router->get('/hello/(\w+)', function ($name) {
            // echo 'Hello ' . htmlentities($name);

            json(200, [
                "status" => 200,
                "message" => "action completed successfully",
                "id" => 44236,
                "user" => $name,
            ]);
        });

        $this->router->post('/login', function () {

            $json = file_get_contents('php://input');
            $someObject = json_decode($json);
            $username = $someObject->username;
            $password = $someObject->password;

            $log = false;
            if ($username === "janko") {
                $log = true;
            }
            if ($password === "jelena420") {
                $log = true;
            } else {
                $log = false;
            }
            if ($log) {
                $user = [
                    "username" => "janko",
                    "id" => 5,
                    "email" => "janko@activecollab.com",
                    "avatar" => null,
                    "instance" => 11356,
                ];
            };
            // echo $log;
            if ($log) {
                json(200, [
                    "status" => 200,
                    "message" => "action completed successfully",
                    "id" => 44236,
                    "user" => $user,
                ]);
            } else {
                json(200, [
                    "status" => 200,
                    "message" => "Bad credentials",
                    "user" => null,
                ]);
            }
        });
    }

    public function run()
    {
        $this->router->run();
    }
}
