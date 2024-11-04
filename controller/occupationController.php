<?php
require_once '../entities/Occupation.php';
require_once '../infra/ConnectionDB.php';

$occupations = [];

try {
    $db = ConnectionDB::getInstance();
    $query = $db->prepare("SELECT * FROM occupations");
    $query->execute();
    $dboccupations = $query->fetchAll(PDO::FETCH_OBJ);

    foreach ($dboccupations as $dboccupation) {
        $occupations[] = new Occupation(
            $dboccupation->id,
            $dboccupation->flight_code,
            $dboccupation->flight_departure_date,
            $dboccupation->purchase_date,
            $dboccupation->seat_number
        );
    }
} catch (Exception $e) {
    echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
}

function getOccupationById($id) {
    header('Content-Type: application/json'); // Define o cabeçalho como JSON

    try {
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("SELECT * FROM occupations WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $dboccupation = $query->fetch(PDO::FETCH_OBJ);

        if ($dboccupation) {
            // Retorna um array associativo em vez do objeto diretamente
            $response = [
                "id" => $dboccupation->id,
                "flightCode" => $dboccupation->flight_code,
                "flightDepartureDate" => $dboccupation->flight_departure_date,
                "purchaseDate" => $dboccupation->purchase_date,
                "seatNumber" => $dboccupation->seat_number
            ];
            echo json_encode($response);
        } else {
            echo json_encode(null); // Ocupação não encontrada
        }
    } catch (Exception $e) {
        echo json_encode(["error" => "Erro ao conectar ou buscar dados: " . $e->getMessage()]);
    }
}

function deleteOccupationById($id) {
    header('Content-Type: application/json'); // Define o cabeçalho como JSON

    try {
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("SELECT * FROM occupations WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $dboccupation = $query->fetch(PDO::FETCH_OBJ);

        if ($dboccupation) {
            $query = $db->prepare("DELETE FROM occupations WHERE id = :id");
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            echo json_encode(["success" => "Ocupação excluída com sucesso!"]);

        } else {
            echo json_encode(["error" => "Ocupação não encontrada"]);
        }
    } catch (Exception $e) {
        echo json_encode(["error" => "Erro ao conectar ou buscar dados: " . $e->getMessage()]);
    }
}

function validateFlight($code)
{
    header('Content-Type: application/json');

    $db = ConnectionDB::getInstance();
    $query = $db->prepare("SELECT * FROM flights WHERE code = :code");
    $query->bindParam(':code', $code, PDO::PARAM_STR);
    $query->execute();
    $flight = $query->fetch(PDO::FETCH_OBJ);

    if ($flight) {
        $response = [
            "flightDepartureDate" => $flight->departure_date,
            "flightDepartureTime" => $flight->departure_time
        ];

        echo json_encode($response);
    } else {
        echo json_encode(["error" => "Vôo não encontrado"]);
    }

}

function validateSeat($seatNumber, $flightCode, $id = null)
{
    header('Content-Type: application/json');

    $db = ConnectionDB::getInstance();
    $query = $db->prepare("SELECT * FROM occupations WHERE seat_number = :seatNumber AND flight_code = :flightCode");
    $query->bindParam(':seatNumber', $seatNumber, PDO::PARAM_STR);
    $query->bindParam(':flightCode', $flightCode, PDO::PARAM_STR);
    $query->execute();
    $occupation = $query->fetch(PDO::FETCH_OBJ);

    if ($occupation && (!$id || $occupation->id = $id)) {
        echo json_encode(["error" => "Assento já ocupado"]);
    } else {
        echo json_encode([]);
    }
}

function insertOccupation ($flightCode, $flightDepartureDate, $purchaseDate, $seatNumber)
{
    if (!$flightCode) {
        echo json_encode(["error" => "Número do vôo é obrigatório"]);
        return;
    }
    if (!$flightDepartureDate) {
        echo json_encode(["error" => "Data de partida é obrigatória"]);
        return;
    }
    if (!$purchaseDate) {
        echo json_encode(["error" => "Data de compra é obrigatória"]);
        return;
    }
    if (!$seatNumber) {
        echo json_encode(["error" => "Número do assento é obrigatório"]);
        return;
    }

    try {
        header('Content-Type: application/json');
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("INSERT INTO occupations (flight_code, flight_departure_date, purchase_date, seat_number) VALUES (:flightCode, :flightDepartureDate, :purchaseDate, :seatNumber)");
        $query->bindParam(':flightCode', $flightCode, PDO::PARAM_STR);
        $query->bindParam(':flightDepartureDate', $flightDepartureDate, PDO::PARAM_STR);
        $query->bindParam(':purchaseDate', $purchaseDate, PDO::PARAM_STR);
        $query->bindParam(':seatNumber', $seatNumber, PDO::PARAM_STR);
        $query->execute();
        echo json_encode(["success" => "Ocupação cadastrada com sucesso!"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Erro ao conectar ou buscar dados: " . $e->getMessage()]);
    }
}

function updateOccupation($id, $flightCode, $flightDepartureDate, $purchaseDate, $seatNumber)
{
    if (!$flightDepartureDate) {
        echo json_encode(["error" => "Data de partida é obrigatória"]);
        return;
    }
    if (!$purchaseDate) {
        echo json_encode(["error" => "Data de compra é obrigatória"]);
        return;
    }
    if (!$seatNumber) {
        echo json_encode(["error" => "Número do assento é obrigatório"]);
        return;
    }

    try {
        header('Content-Type: application/json');
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("UPDATE occupations SET flight_code = :flightCode, flight_departure_date = :flightDepartureDate, purchase_date = :purchaseDate, seat_number = :seatNumber WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':flightCode', $flightCode, PDO::PARAM_STR);
        $query->bindParam(':flightDepartureDate', $flightDepartureDate, PDO::PARAM_STR);
        $query->bindParam(':purchaseDate', $purchaseDate, PDO::PARAM_STR);
        $query->bindParam(':seatNumber', $seatNumber, PDO::PARAM_STR);
        $query->execute();
        echo json_encode(["success" => "Ocupação atualizada com sucesso!"]);
    } catch (Exception $e) {
        echo json_encode(["error" => "Erro ao conectar ou buscar dados: " . $e->getMessage()]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        updateOccupation($_POST['id'], $_POST['flightCode'], $_POST['flightDepartureDate'], $_POST['purchaseDate'], $_POST['seatNumber']);
    } else {
        insertOccupation($_POST['flightCode'], $_POST['flightDepartureDate'], $_POST['purchaseDate'], $_POST['seatNumber']);
    }
    exit;
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'getOccupationById' && isset($_GET['id'])) {
        getOccupationById($_GET['id']);
        exit;
    } elseif ($_GET['action'] == 'deleteOccupation' && isset($_GET['id'])) {
        deleteOccupationById($_GET['id']);
        exit;
    } elseif ($_GET['action'] == 'validateFlight' && isset($_GET['code'])) {
        validateFlight($_GET['code']);
        exit;
    } elseif ($_GET['action'] == 'validateSeat' && isset($_GET['seatNumber']) && isset($_GET['flightCode'])) {
        validateSeat($_GET['seatNumber'], $_GET['flightCode']);
        exit;
    }
}

include '../view/occupation/list.php';