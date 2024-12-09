<?php
require 'vendor/autoload.php';

class LoginController
{
    public $error = false;

    public function login($username, $password)
    {
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_OBJ);

        if ($user) {
            session_start();
            $_SESSION['logged'] = true;
            $_SESSION['user'] = $username;

            header('Location: /home');
            exit();
        }

        $this->error = true;
        $this->isLogged();
        exit();
    }

    public function isLogged()
    {
        if (CheckAuthenticationService::isLogged()) {
            header('Location: /home');
        } else {
            $error = $this->error;
            require_once 'view/login.php';
        }
    }
}
