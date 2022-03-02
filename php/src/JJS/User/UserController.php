<?php

/**
 * @author      Janko Stanic <jjsolutions034@gmail.com>
 * @copyright   Copyright (c), 2022 Janko Stanic
 * @license     MIT public license
 */

namespace JJS\User;

class UserController
{
  public $router;
  public $user;
  public $login_route;
  public $register_route;

  public function __construct($router, $user)
  {
    $this->router = $router;
    $this->user = $user;
    $this->login_route = '/login';
    $this->register_route = '/register';
    $this->setLoginRoute();
    $this->setAboutRoute();
    $this->setRegisterRouter();
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
      $payload_json = file_get_contents('php://input');
      $payload_object = json_decode($payload_json);
      $username = $payload_object->username;
      $password = $payload_object->password;

      $response = $this->user->login($username, $password);
      if ($response) {
        if ($response['status_code'] === 200) {
          json($response['status_code'], [
            "entities" => [
              "user" => $response['message'],
            ]
          ]);
        } else {
          json($response['status_code'], [
            "error" => $response['message'],
          ]);
        }
      }
    });
  }

  public function setRegisterRouter()
  {
    $this->router->post($this->register_route, function () {
      $payload_json = file_get_contents('php://input');
      $payload_object = json_decode($payload_json);
      $this->user->register($payload_object);
      // $response = $this->user->register($payload_object);
      // json($response['status_code'], [
      //   "message" => $response['message'],
      // ]);
    });
  }
}
