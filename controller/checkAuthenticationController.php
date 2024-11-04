<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['logged']) || !$_SESSION['logged']) {
    //alterar para que busque pelas rotas
    header('Location: /login');
}