<?php

/**
 * @author      Janko Stanic <jjsolutions034@gmail.com>
 * @copyright   Copyright (c), 2022 Janko Stanic
 * @license     MIT public license
 */

class UserController
{
    public $router;
    public $login_route;

    public function __construct($router)
    {
        $this->router = $router;
        $this->login_route = '/login';
        $this->setLoginRoute();
        $this->setAboutRoute();
    }

    public function setAboutRoute()
    {
        $this->router->get('/about', function () {
            echo 'About Page Contents';
        });
    }

    public function setLoginRoute()
    {
        $this->router->post($this->login_route, function () {
            $json = file_get_contents('php://input');
            $someObject = json_decode($json);
            $username = $someObject->username;
            $password = $someObject->password;

            // saljemo u odgovarajucu model metodu
            // eventualno vraca odgovor

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
}
