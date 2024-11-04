<?php
session_start();
require_once 'entities/Plane.php';
require_once 'infra/ConnectionDB.php';

if (empty($_SESSION['logged']) || !$_SESSION['logged']) {
    echo "Usuário não logado. Redirecionando para login...";
    header('Location: /login');
    exit;
}

$db = ConnectionDB::getInstance();
$planes = [];

// Ações
if ($acao == 'list') {

    try {
        $query = $db->prepare("SELECT * FROM planes");
        $query->execute();
        $dbplanes = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($dbplanes as $dbplane) {
            $planes[] = new Plane($dbplane->code, $dbplane->model, $dbplane->total_seats, $dbplane->id);
        }
    } catch (Exception $e) {
        echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
    }

} else if ($acao == 'getById') {
    try {
        $query = $db->prepare("SELECT * FROM planes WHERE id = :id");
        $query->bindParam(':id', $_GET['id']);
        $query->execute();
        $dbplane = $query->fetch(PDO::FETCH_OBJ);

        $plane = new Plane($dbplane->code, $dbplane->model, $dbplane->total_seats, $dbplane->id);

        if ($dbplane) {
            // Retorna um array associativo em vez do objeto diretamente
            $response = [
                "id" => $dbplane->id,
                "code" => $dbplane->code,
                "model" => $dbplane->model,
                "totalSeats" => $dbplane->total_seats
            ];
            echo json_encode($response);
        } else {
            echo json_encode(null); // Ocupação não encontrada
        }
    } catch (Exception $e) {
        echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
    }
} else if ($acao == 'save') {
    try {
        if (empty($_POST['id'])) {
            $query = $db->prepare("INSERT INTO planes(code, model, total_seats) VALUES(:code, :model, :totalSeats)");
        } else {
            $query = $db->prepare("UPDATE planes SET code = :code, model = :model, total_seats = :totalSeats WHERE id = :id");
            $query->bindParam(':id', $_POST['id']);
        }
        $query->bindParam(':code', $_POST['code']);
        $query->bindParam(':model', $_POST['model']);
        $query->bindParam(':totalSeats', $_POST['totalSeats']);
        $query->execute();
        header('Location: /plane/list');
    } catch (Exception $e) {
        echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
    }
} else if ($acao == 'delete') {
    try {
        $query = $db->prepare("DELETE FROM planes WHERE id = :id");
        $query->bindParam(':id', $_GET['id']);
        $query->execute();

        header('Location: /plane/list');
    } catch (Exception $e) {
        echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
    }
}

require_once 'views.php';
