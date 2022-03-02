<?php

/**
 * @author      Janko Stanic <jjsolutions034@gmail.com>
 * @copyright   Copyright (c), 2022 Janko Stanic
 * @license     MIT public license
 */

namespace JJS\Models;

class User
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $first_name;
    public $last_name;
    public $gender;
    public $locale;
    public $picture;
    public $created;
    public $modified;
    public $queryBuilder;
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // public function up()
    // {
    //     // Create table
    // }

    public function populate($userArray)
    {
        $this->id = $userArray['id'];
        $this->username = $userArray['username'];
        $this->password = $userArray['password'];
        $this->email = $userArray['email'];
        $this->first_name = $userArray['first_name'];
        $this->last_name = $userArray['last_name'];
        $this->gender = $userArray['gender'];
        $this->locale = $userArray['locale'];
        $this->picture = $userArray['picture'];
        $this->created = $userArray['created'];
        $this->modified = $userArray['modified'];
    }

    public function fetchUserData($show_password)
    {
        $userObj['id'] = $this->id;
        $userObj['username'] = $this->username;
        if ($show_password) {
            $userObj['password'] = $this->password;
        }
        $userObj['email'] = $this->email;
        $userObj['first_name'] = $this->first_name;
        $userObj['last_name'] = $this->last_name;
        $userObj['gender'] = $this->gender;
        $userObj['locale'] = $this->locale;
        $userObj['picture'] = $this->picture;
        $userObj['created'] = $this->created;
        $userObj['modified'] = $this->modified;
        return $userObj;
    }

    public function login($username, $password)
    {
        $requested_user = $this->db->query('SELECT * FROM users WHERE username = ?', $username)->fetchArray();
        if ($requested_user) {
            if (password_verify($password, $requested_user['password'])) {
                $this->populate($requested_user);
                $message = $this->fetchUserData(false);
                $status_code = 200;
            } else {
                $message = 'Wrong password.';
                $status_code = 403;
            }
        } else {
            $message = 'Wrong username.';
            $status_code = 404;
        }
        return $response = [
            'status_code' => $status_code,
            'message' => $message
        ];
    }

    public function register($user_data)
    {
        if ($user_data->username) {
            $username_in_use = $this->db->query('SELECT * FROM users WHERE username = ?', $user_data->username);
            if ($username_in_use->numRows() === 1) {
                $message = 'Username in use.';
                $status_code = 403;
                return $response = [
                    'status_code' => $status_code,
                    'message' => $message
                ];
            } else {
                var_dump($user_data);
                // $insert = $this->db->query('INSERT INTO users (username,password,email,name) VALUES (?,?,?,?)', 'test', 'test', 'test@gmail.com', 'Test');
                // echo $insert->affectedRows();
            }
        }
        $message = 'Bad request.';
        // @ToDo: Change code
        $status_code = 403;
        return $response = [
            'status_code' => $status_code,
            'message' => $message
        ];
        // if ($requested_user) {
        //     if (password_verify($password, $requested_user['password'])) {
        //         $this->populate($requested_user);
        //         $message = $this->fetchUserData(false);
        //         $status_code = 200;
        //     } else {
        //         $message = 'Wrong password.';
        //         $status_code = 403;
        //     }
        // } else {
        //     $message = 'Wrong username.';
        //     $status_code = 404;
        // }
        // return $response = [
        //     'status_code' => $status_code,
        //     'message' => $message
        // ];
    }
}
