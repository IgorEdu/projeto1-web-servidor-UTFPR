<?php

session_start();

if (empty($_SESSION['logged']) || !$_SESSION['logged']) {
    header('Location: ../view/login.php');
}