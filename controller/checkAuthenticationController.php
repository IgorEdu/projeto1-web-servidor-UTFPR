<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['logged']) || !$_SESSION['logged']) {
    echo "Usuário não logado. Redirecionando para login...";
    header('Location: /login');
}