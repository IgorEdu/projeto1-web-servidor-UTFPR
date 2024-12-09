<?php
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

        $DBOccupations =  OccupationService::findOccupationList();

        $response = array();

        foreach($DBOccupations as $ocupation){

            $flightInfo = FlightService::getOcupationInfo($ocupation->getFlightId());

            $flightCode = $flightInfo["flightCode"];

            $date = new DateTime($flightInfo["departureDate"]);
            $flightDepartureDate = $date->format('d/m/Y');

            $response[] = new TableOccupation(
                $flightCode, 
                $flightDepartureDate, 
                $ocupation->getPurchaseDate(), 
                $ocupation->getSeatNumber(), 
                $ocupation->getId()
            );
        }

        $occupations = $response;

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

            if ($occupation !== null) {
                // Retorna um array associativo em vez do objeto diretamente

                $flightInfo = FlightService::getOcupationInfo($occupation->getFlightId());

                $flightCode = $flightInfo["flightCode"];
                $flightDepartureDate = $flightInfo["departureDate"];

                $response = [
                    "id" => $occupation->getId(),
                    "flightCode" => $flightCode,
                    "flightDepartureDate" => $flightDepartureDate,
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
        if (!$purchaseDate) {
            echo json_encode(["error" => "Data de compra é obrigatória"]);
            return;
        }
        if (!$seatNumber) {
            echo json_encode(["error" => "Número do assento é obrigatório"]);
            return;
        }

        try {
            $flightId = FlightService::getIdByCode($flightCode);
            $occupation = new Occupation($flightId, $purchaseDate, $seatNumber);
            OccupationService::insertOccupation($occupation);

            echo json_encode(['message' => 'Ocupação criada com sucesso']);
        } catch (Exception $e) {
            echo json_encode(["error" => "Erro ao conectar ou buscar dados: " . $e->getMessage()]);
        }

    }

    function updateOccupation($id, $flightCode, $flightDepartureDate, $purchaseDate, $seatNumber)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
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
            $flightId = FlightService::getIdByCode($flightCode);
            $occupation = new Occupation($flightId, $purchaseDate, $seatNumber, $id);

            OccupationService::updateOccupation($occupation);
            echo json_encode(['message' => 'Ocupação atualizada com sucesso']);
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    function validateFlight($code)
    {
        echo OccupationService::validateFlight($code);
    }

    function validateSeat($flightCode, $seatNumber, $id = null)
    {
        echo OccupationService::validateSeat( $flightCode,$seatNumber, $id);
    }
}