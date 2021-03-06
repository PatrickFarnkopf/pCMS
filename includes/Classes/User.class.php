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

    public function __construct($id = false) {
        self::registerSelf('user', $this);

        if ($id !== false) {
            $result = self::getInstance('\Classes\MySQL')->Query('SELECT * FROM user WHERE id = '.$id);
            if ($row = $result->fetch()) {
                $this->setId($id);
                $this->setUsername($row->username);
                $this->setEmail($row->email);
                $this->password = $row->password;
                return;
            }
        }

        if (isset($_SESSION['is_loggedin']) && $_SESSION['is_loggedin']) {
            $this->username = $_SESSION['username'];
            $this->id = $_SESSION['id'];
            $result = self::getInstance('\Classes\MySQL')->Query('SELECT * FROM user WHERE id = '.$this->id);
            if ($row = $result->fetch()) {
                $this->password = $row->password;
                $this->email = $row->email;
            }
        }
    }

    public function setUsername($name) {
        $this->username = $name;
        $_SESSION['username'] = $name;
    }

    public function setPassword($pass) {
        $this->password = md5($pass);
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setId($id) {
        $this->id = $id;
        $_SESSION['id'] = $id;
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

    public function getId() {
        return $this->id;
    }

    public function isLoggedIn() {
        return isset($_SESSION['is_loggedin']);
    }

    public function auth() {
        $result = self::getInstance('\Classes\MySQL')->Query("SELECT * FROM user WHERE username = '".$this->username."'");
        if ($row = $result->fetch()) {
            if ($row->password == $this->getPassword()) {
                $_SESSION['is_loggedin'] = true;
                $this->setId($row->id);
                $this->setUsername($row->username);
                self::getInstance('\Classes\Scripting\UserScript')->_OnLogin($this);
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

        self::getInstance('\Classes\MySQL')->Query("INSERT INTO user (username, password, email) VALUES ('".$this->getUsername()."','".$this->getPassword()."', '".$this->getEmail()."')");
        self::getInstance('\Classes\Scripting\UserScript')->_OnRegister($this, $status);
        return $status;
    }

    public function saveToDB() {
        self::getInstance('\Classes\MySQL')->Query('UPDATE user SET username = \''.$this->getUsername().'\', password = \''.$this->getPassword().'\', email = \''.$this->getEmail().'\' WHERE id = '.$this->getId());
    }

    public function logout() {
        self::getInstance('\Classes\Scripting\UserScript')->_OnLogout($this);
        $_SESSION = [];
    }

    public static function getUsers() {
        $users = [];
        $result = self::getInstance('\Classes\MySQL')->Query('SELECT * FROM user');
        for ($i = 0; $row = $result->fetch(); $i++) {
            $users[$i]['id'] = $row->id;
            $users[$i]['name'] = $row->username;
            $users[$i]['email'] = $row->email;
        }
        return $users;
    }

    public static function delete($id) {
        if (self::getInstance('\Classes\MySQL')->Query('SELECT * FROM user WHERE id = '.$id)->getRowsCount()) {
            self::getInstance('\Classes\MySQL')->Query('DELETE FROM user WHERE id = '.$id);
            return 1;
        }
        else 
            return 2;
    }
}

?>
