<?php

/**
 * @author      Janko Stanic <jjsolutions034@gmail.com>
 * @copyright   Copyright (c), 2022 Janko Stanic
 * @license     MIT public license
 */

namespace User;

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
    public $created_at;
    public $last_modified_at;
    public $queryBuilder;
    public $conn;

    public function populate(
        $id,
        $username,
        $password,
        $email,
        $first_name,
        $last_name,
        $gender,
        $locale,
        $picture,
        $created_at,
        $last_modified_at
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->gender = $gender;
        $this->locale = $locale;
        $this->picture = $picture;
        $this->created_at = $created_at;
        $this->last_modified_at = $last_modified_at;
    }

    public function register(
        $username,
        $password,
        $email,
        $first_name,
        $last_name,
        $gender,
        $locale,
        $picture,
    ) {
        $date_now = date('Y-m-d H:i:s');
        $this->queryBuilder
            ->insert('users')
            ->setValue('id', '?')
            ->setValue('username', '?')
            ->setValue('password', '?')
            ->setValue('email', '?')
            ->setValue('first_name', '?')
            ->setValue('last_name', '?')
            ->setValue('gender', '?')
            ->setValue('locale', '?')
            ->setValue('picture', '?')
            ->setValue('created_at', '?')
            ->setValue('last_modified_at', '?')
            ->setParameter(0, null)
            ->setParameter(1, $username)
            ->setParameter(2, $password)
            ->setParameter(3, $email)
            ->setParameter(4, $first_name)
            ->setParameter(5, $last_name)
            ->setParameter(6, $gender)
            ->setParameter(7, $locale)
            ->setParameter(5, $picture)
            ->setParameter(6, $date_now)
            ->setParameter(7, $date_now);
    }
}
