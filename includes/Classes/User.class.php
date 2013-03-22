<?php

/**
* Licensed under The Apache License
*
* @copyright Copyright 2013 Patrick Farnkopf
* @link https://github.com/PatrickFarnkopf/pCMS
* @license Apache License v2 (http://www.apache.org/licenses/LICENSE-2.0.txt)
* @author Patrick Farnkopf
*
*/

namespace Classes;
class User extends \Classes\Singleton {
    private $username, $password, $email, $id;

    public function __construct() {
        self::registerSelf('user', $this);
        if (isset($_SESSION['is_loggedin']) && $_SESSION['is_loggedin']) {
            $this->username = $_SESSION['username'];
            $this->id = $_SESSION['id'];
            $result = self::getInstance('\Classes\MySQL')->Query("SELECT * FROM user WHERE id = ".$this->id);
            if ($row = $result->fetch()) {
                $this->password = $row->password;
                $this->email = $row->email;
            }
        }
    }

    public function setUsername($name) {
        $this->username = $name;
    }

    public function setPassword($pass) {
        $this->password = $pass;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function isLoggedIn() {
        return isset($_SESSION['is_loggedin']);
    }

    public function auth() {
        $result = self::getInstance('\Classes\MySQL')->Query("SELECT * FROM user WHERE username = '".$this->username."'");
        if ($row = $result->fetch()) {
            if ($row->password == md5($this->getPassword())) {
                $_SESSION['is_loggedin'] = true;
                $_SESSION['username'] = $row->username;
                $_SESSION['id'] = $row->id;
                return true;
            }
        }

        return false;
    }

    public function register() {
        $status = 0;
        $result = self::getInstance('\Classes\MySQL')->Query("SELECT * FROM user WHERE username = '".$this->getUsername()."' OR email = '".$this->getEmail()."'");
        while ($row = $result->fetch()) {
            if ($row->username == $this->getUsername())
                $status += 1;
            if ($row->email == $this->getEmail())
                $status += 2;
        }

        if ($status > 0)
            return $status;
        else
            $status = 4;

        self::getInstance('\Classes\MySQL')->Query("INSERT INTO user (username, password, email) VALUES ('".$this->getUsername()."','".md5($this->getPassword())."', '".$this->getEmail()."')");

        return $status;
    }

    public static function getUsers() {
        $users = [];
        $result = self::getInstance('\Classes\MySQL')->Query("SELECT * FROM user");
        for ($i = 0; $row = $result->fetch(); $i++) {
            $users[$i]['id'] = $row->id;
            $users[$i]['name'] = $row->username;
            $users[$i]['email'] = $row->email;
        }
        return $users;
    }
}

?>
