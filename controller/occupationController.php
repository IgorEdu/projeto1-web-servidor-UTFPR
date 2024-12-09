<?php
// require_once '../entities/Occupation.php';
// require_once '../infra/ConnectionDB.php';
require 'vendor/autoload.php';

class OccupationController
{
    private $occupations = array();

    public function getOccupations()
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        $occupations =  OccupationService::findOccupationList();

        require_once 'view/occupation/list.php';
    }

    function getOccupationById($id)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }
        // header('Content-Type: application/json'); // Define o cabeçalho como JSON
        try {
            $occupation = OccupationService::getOccupationById($id);

            if ($occupation) {
                // Retorna um array associativo em vez do objeto diretamente
                $response = [
                    "id" => $occupation->getId(),
                    "flightCode" => $occupation->getFlightCode(),
                    "flightDepartureDate" => $occupation->getFlightDepartureDate(),
                    "purchaseDate" => $occupation->getPurchaseDate(),
                    "seatNumber" => $occupation->getSeatNumber()
                ];
                echo json_encode($response);
            } else {
                echo json_encode(null);
            }
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    function deleteOccupationById($id)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }
        // header('Content-Type: application/json'); // Define o cabeçalho como JSON

        try {
            echo OccupationService::deleteOccupationById($id);
            // header('Location: /occupation/list');
        } catch (Exception $e) {
            echo json_encode(["error" => "Erro ao conectar ou buscar dados: " . $e->getMessage()]);
        }
    }

    public function save($flightCode, $flightDepartureDate, $purchaseDate, $seatNumber, $id)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        try {
            if (empty($id)) {
                $this->insertOccupation($flightCode, $flightDepartureDate, $purchaseDate, $seatNumber);
            } else {
                $this->updateOccupation($id, $flightCode, $flightDepartureDate, $purchaseDate, $seatNumber);
            }
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    function insertOccupation($flightCode, $flightDepartureDate, $purchaseDate, $seatNumber)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

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
            $occupation = new Occupation($flightCode, $flightDepartureDate, $purchaseDate, $seatNumber);
            OccupationService::insertOccupation($occupation);

            echo json_encode(['message' => 'Ocupação criada com sucesso']);
        } catch (Exception $e) {
            echo json_encode(["error" => "Erro ao conectar ou buscar dados: " . $e->getMessage()]);
        }

        // try {
        //     header('Content-Type: application/json');
        //     $db = ConnectionDB::getInstance();
        //     $query = $db->prepare("INSERT INTO occupations (flight_code, flight_departure_date, purchase_date, seat_number) VALUES (:flightCode, :flightDepartureDate, :purchaseDate, :seatNumber)");
        //     $query->bindParam(':flightCode', $flightCode, PDO::PARAM_STR);
        //     $query->bindParam(':flightDepartureDate', $flightDepartureDate, PDO::PARAM_STR);
        //     $query->bindParam(':purchaseDate', $purchaseDate, PDO::PARAM_STR);
        //     $query->bindParam(':seatNumber', $seatNumber, PDO::PARAM_STR);
        //     $query->execute();
        //     echo json_encode(["success" => "Ocupação cadastrada com sucesso!"]);
        // } catch (Exception $e) {
        //     echo json_encode(["error" => "Erro ao conectar ou buscar dados: " . $e->getMessage()]);
        // }
    }

    function updateOccupation($id, $flightCode, $flightDepartureDate, $purchaseDate, $seatNumber)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
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
            $occupation = new Occupation($flightCode, $flightDepartureDate, $purchaseDate, $seatNumber, $id);

            OccupationService::updateOccupation($occupation);
            echo json_encode(['message' => 'Ocupação atualizada com sucesso']);
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }

        // try {
        //     header('Content-Type: application/json');
        //     $db = ConnectionDB::getInstance();
        //     $query = $db->prepare("UPDATE occupations SET flight_code = :flightCode, flight_departure_date = :flightDepartureDate, purchase_date = :purchaseDate, seat_number = :seatNumber WHERE id = :id");
        //     $query->bindParam(':id', $id, PDO::PARAM_INT);
        //     $query->bindParam(':flightCode', $flightCode, PDO::PARAM_STR);
        //     $query->bindParam(':flightDepartureDate', $flightDepartureDate, PDO::PARAM_STR);
        //     $query->bindParam(':purchaseDate', $purchaseDate, PDO::PARAM_STR);
        //     $query->bindParam(':seatNumber', $seatNumber, PDO::PARAM_STR);
        //     $query->execute();
        //     echo json_encode(["success" => "Ocupação atualizada com sucesso!"]);
        // } catch (Exception $e) {
        //     echo json_encode(["error" => "Erro ao conectar ou buscar dados: " . $e->getMessage()]);
        // }
    }

    function validateFlight($code)
    {
        echo OccupationService::validateFlight($code);
    }

    function validateSeat($flightCode, $seatNumber, $id = null)
    {
        echo OccupationService::validateSeat( $flightCode,$seatNumber, $id);
    }

    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['id'])) {
//         updateOccupation($_POST['id'], $_POST['flightCode'], $_POST['flightDepartureDate'], $_POST['purchaseDate'], $_POST['seatNumber']);
//     } else {
//         insertOccupation($_POST['flightCode'], $_POST['flightDepartureDate'], $_POST['purchaseDate'], $_POST['seatNumber']);
//     }
//     exit;
// }

    // if (isset($_GET['action'])) {
//     if ($_GET['action'] == 'getOccupationById' && isset($_GET['id'])) {
//         getOccupationById($_GET['id']);
//         exit;
//     } elseif ($_GET['action'] == 'deleteOccupation' && isset($_GET['id'])) {
//         deleteOccupationById($_GET['id']);
//         exit;
//     } elseif ($_GET['action'] == 'validateFlight' && isset($_GET['code'])) {
//         validateFlight($_GET['code']);
//         exit;
//     } elseif ($_GET['action'] == 'validateSeat' && isset($_GET['seatNumber']) && isset($_GET['flightCode'])) {
//         validateSeat($_GET['seatNumber'], $_GET['flightCode']);
//         exit;
//     }
// }

    // include '../view/occupation/list.php';

}