<?php

/**
 * @author      Janko Stanic <jjsolutions034@gmail.com>
 * @copyright   Copyright (c), 2022 Janko Stanic
 * @license     MIT public license
 */

namespace JJS\User;

use JJS\Db\Db;

class User extends Db
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

    public function initTable()
    {
        $sql_create = "CREATE TABLE IF NOT EXISTS users (
            id int NOT NULL,
            username varchar(255) COLLATE utf8_unicode_ci NOT NULL,
            password varchar(9999) COLLATE utf8_unicode_ci NOT NULL,
            first_name varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            last_name varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            email varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            gender varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
            locale varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
            picture varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
            created datetime NOT NULL,
            modified datetime NOT NULL,
            PRIMARY KEY (id)
        )";
        $this->query($sql_create);

        $hashed_pwd = '$2y$10$wMg0r4z3EuTBy8KvHuYYPeK8cbhQJ4kCbaEtF9iQMeLRz8JMUJJSS';

        $sql_is_table_empty = "SELECT * FROM users";
        $users_num_rows = $this->query($sql_is_table_empty)->numRows() === 0;

        $sql_fill_data = "INSERT INTO users (id, username, password, first_name, last_name, email, `gender`, locale, picture, created, modified) VALUES
        (6, 'janko', '$hashed_pwd', 'janko@jankovic.rs', 'janko', 'stanic', NULL, NULL, NULL, '2022-03-04 10:52:09', '2022-03-04 10:52:09')";

        if ($users_num_rows) {
            $this->query($sql_fill_data);
        } else {
            echo "Users table exists and has data in it.";
        }
    }

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
        $requested_user = $this->query('SELECT * FROM users WHERE username = ?', $username)->fetchArray();
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

    public function isUsernameInUse($provided_username)
    {
        $query = $this->query('SELECT * FROM users WHERE username = ?', $provided_username);
        return $query->numRows() === 1;
    }

    public function register($user_data)
    {
        if ($user_data->username) {
            if ($this->isUsernameInUse($user_data->username)) {
                $message = 'Username in use.';
                $status_code = 403;
                return $response = [
                    'status_code' => $status_code,
                    'error' => $message
                ];
            } else {
                $hashed_password = password_hash($user_data->password, PASSWORD_DEFAULT);
                $date_now = date('Y-m-d H:i:s');
                $insert = $this->query(
                    'INSERT INTO users
                     (id, username, password, first_name, last_name, email, gender, locale, picture, created, modified)
                     VALUES (null,?,?,?,?,?,null,null,null,?,?)',
                    $user_data->username,
                    $hashed_password,
                    $user_data->email,
                    $user_data->first_name,
                    $user_data->last_name,
                    $date_now,
                    $date_now
                );
                if ($insert->affectedRows() === 1) {
                    $message = 'Registration successfull.';
                    $status_code = 200;
                    return $response = [
                        'status_code' => $status_code,
                        'message' => $message
                    ];
                } else {
                    $message = 'Something went wrong. Please try again in a few minutes.';
                    $status_code = 403;
                    return $response = [
                        'status_code' => $status_code,
                        'error' => $message
                    ];
                }
            }
        }
        $message = 'Bad request.';
        $status_code = 403;
        return $response = [
            'status_code' => $status_code,
            'error' => $message
        ];
    }
}
