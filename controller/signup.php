<?php
// require("../mock/users-mock.php");
require_once("../infra/ConnectionDB.php");

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password-confirm'] ?? '';
$error = false;
$exists = false;

function userExists($username){
    $db = ConnectionDB::getInstance();
    $query = $db->prepare("SELECT * FROM users WHERE username = :username");
    $query->bindParam(':username', $username);
    $query->execute();
    $user = $query->fetch();
    return !empty($user);
}

function signup($username, $password){
    // $usersMock = $_SESSION['usersMock'];

    if(userExists($username)){
        return false;
    }

    $db = ConnectionDB::getInstance();
    $query = $db->prepare("INSERT INTO users(username, password) VALUES(:username, :password)");
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);
    $query->execute();
    // array_push($usersMock,[$username, $password]);
    // print_r($usersMock);
    // $_SESSION['usersMock'] = $usersMock;
    return true;
}

if (!empty($_SESSION['logged']) && $_SESSION['logged']) {
    header('Location: ../view/home.php');
}

if (!empty($_POST) && userExists($username)) {
    $exists = true;
    $error = false;
} else if ($password != $password_confirm) {
    $error = true;
    $exists = false;
} 


if(!empty($_POST) && signup($username, $password)){
    header('Location: ../view/login.php');
}