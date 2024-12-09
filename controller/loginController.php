<?php

// use Pecee\Http\Request;
// require_once("infra/ConnectionDB.php");

// $username = $_POST['username'] ?? '';
// $password = $_POST['password'] ?? '';
// $error = false;

// class LoginController{

//     // function login($username, $password)
//     function login($data)
//     {

//         // if (!empty($_POST) && login($username, $password)) {
//         //     session_start();
//         //     $_SESSION['logged'] = true;
//         //     $_SESSION['user'] = $username;

//         //     header('Location: /home');
//         // } else if (!empty($_POST)) {
//         //     $error = true;
//         // }

//         $username = $data['username'];
//         $password = $data['password'];

//         $db = ConnectionDB::getInstance();
//         $query = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
//         $query->bindParam(':username', $username);
//         $query->bindParam(':password', $password);
//         $query->execute();
//         $user = $query->fetchAll(PDO::FETCH_OBJ);

//         if ($user) {
//             return true;
//         }
//         return false;
//     }

//     public function isLogged(){   
//         if (!empty($_SESSION['logged']) && $_SESSION['logged']) {
//             header('Location: /home');
//         }

//         // require_once 'views.php';
//         require_once 'view/login.php';
//     }
// }

// require_once("infra/ConnectionDB.php");

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
