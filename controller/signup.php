<?php
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password-confirm'] ?? '';
$error = false;
$exists = false;

session_start();

if (!empty($_POST) && $username == 'admin') {
    $exists = true;
    $error = false;
} else if ($password != $password_confirm) {
    $error = true;
    $exists = false;
} 

if (!empty($_SESSION['logged']) && $_SESSION['logged']) {
    header('Location: ../view/home.php');
}