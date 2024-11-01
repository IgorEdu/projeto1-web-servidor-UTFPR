<?php
// require("../mock/users-mock.php");
require_once("../infra/ConnectionDB.php");

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$error = false;

function login($username, $password) {
    // $usersMock = $_SESSION['usersMock'] ?? [["admin", "123456"],["fulano", "senhaforte"], ["teste", "senha"]];
    $db = ConnectionDB::getInstance();
    $query = $db->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->execute();
    $user = $query->fetchAll(PDO::FETCH_OBJ);
    // print_r($usersMock);
    // foreach($usersMock as $u){
    //     if($u[0] == $user && $u[1] == $pass){
    //         return true;
    //     }
    // }
    if($user){
        return true;
    }
    return false;
}



if(!empty($_POST) && login($username, $password)){
    session_start();
    $_SESSION['logged'] = true;
    $_SESSION['user'] = $username;

    header('Location: ../view/home.php');
}

else if (!empty($_POST)) {
    $error = true;
}

if (!empty($_SESSION['logged']) && $_SESSION['logged']) {
    header('Location: ../view/home.php');
}