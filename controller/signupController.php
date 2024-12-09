<?php
require 'vendor/autoload.php';

class SignupController
{
    private $error = false;
    private $exists = false;

    function userExists($username)
    {
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();
        $user = $query->fetch();
        return !empty($user);
    }

    function signup($username, $password, $password_confirm)
    {
        if (!empty($_POST) && $this->userExists($username)) {
            $this->exists = true;
            $this->isLogged();

            exit();
        } else if ($password != $password_confirm) {
            $this->error = true;
            $this->isLogged();

            exit();
        }

        $db = ConnectionDB::getInstance();
        $query = $db->prepare("INSERT INTO users(username, password) VALUES(:username, :password)");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->execute();

        require_once 'view/login.php';
        return true;
    }

    public function isLogged()
    {
        if(CheckAuthenticationService::isLogged()){
            header('Location: /home');
        } else {
            $error = $this->error;
            $exists = $this->exists;
            require_once 'view/signup.php';
        }
    }

}