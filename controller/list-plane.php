<?php
session_start();
require_once '../entities/Plane.php';
require_once '../infra/ConnectionDB.php';

$planes = [];

if (empty($_SESSION['logged']) || !$_SESSION['logged']) {
    echo "Usuário não logado. Redirecionando para login...";
    header('Location: ../view/login.php');
    exit;
}

try {   
    $db = ConnectionDB::getInstance();
    $query = $db->prepare("SELECT * FROM planes");
    $query->execute();
    $dbplanes = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($dbplanes as $dbplane) {
        $planes[] = new Plane($dbplane->code, $dbplane->model, $dbplane->total_seats, $dbplane->id);
    }
} catch (Exception $e) {
    echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
}

require_once '../view/plane/list-plane.php';
