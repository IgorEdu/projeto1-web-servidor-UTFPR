<?php
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$error = false;

session_start();

if ($username == 'admin' && $password == '123456') {
    $_SESSION['logged'] = true;
    $_SESSION['user'] = 'Administrador';

    header('Location: ../view/home.php');
} else if (!empty($_POST)) {
    $error = true;
}

if (!empty($_SESSION['logged']) && $_SESSION['logged']) {
    header('Location: ../view/home.php');
}