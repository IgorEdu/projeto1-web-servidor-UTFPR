<?php
require 'vendor/autoload.php';

class OccupationService
{
    public static function findOccupationList()
    {
        try {
            $db = ConnectionDB::getInstance();
            $query = $db->prepare("SELECT * FROM occupations");
            $query->execute();
            $dboccupations = $query->fetchAll(PDO::FETCH_OBJ);

            $occupations = array();

            foreach ($dboccupations as $dboccupation) {
                $occupations[] = new Occupation(
                    $dboccupation->flight_code,
                    $dboccupation->flight_departure_date,
                    $dboccupation->purchase_date,
                    $dboccupation->seat_number,
                    $dboccupation->id
                );
            }

            return $occupations;
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    public static function getOccupationById($id)
    {
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("SELECT * FROM occupations WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $dboccupation = $query->fetch(PDO::FETCH_OBJ);

        $occupation = new Occupation(
            $dboccupation->flight_code,
            $dboccupation->flight_departure_date,
            $dboccupation->purchase_date,
            $dboccupation->seat_number,
            $dboccupation->id
        );

        return $occupation;
    }

    public static function insertOccupation(&$occupation)
    {
        $flightCode = $occupation->getFlightCode();
        $flightDepartureDate = $occupation->getFlightDepartureDate();
        $purchaseDate = $occupation->getPurchaseDate();
        $seatNumber = $occupation->getSeatNumber();

        $db = ConnectionDB::getInstance();

        $query = $db->prepare("INSERT INTO occupations (flight_code, flight_departure_date, purchase_date, seat_number) VALUES (:flightCode, :flightDepartureDate, :purchaseDate, :seatNumber)");
        $query->bindParam(':flightCode', $flightCode, PDO::PARAM_STR);
        $query->bindParam(':flightDepartureDate', $flightDepartureDate, PDO::PARAM_STR);
        $query->bindParam(':purchaseDate', $purchaseDate, PDO::PARAM_STR);
        $query->bindParam(':seatNumber', $seatNumber, PDO::PARAM_STR);
        $query->execute();
    }

    public static function updateOccupation(&$occupation)
    {
        $id = $occupation->getId();
        $flightCode = $occupation->getFlightCode();
        $flightDepartureDate = $occupation->getFlightDepartureDate();
        $purchaseDate = $occupation->getPurchaseDate();
        $seatNumber = $occupation->getSeatNumber();

        $db = ConnectionDB::getInstance();
        $query = $db->prepare("UPDATE occupations SET flight_code = :flightCode, flight_departure_date = :flightDepartureDate, purchase_date = :purchaseDate, seat_number = :seatNumber WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':flightCode', $flightCode, PDO::PARAM_STR);
        $query->bindParam(':flightDepartureDate', $flightDepartureDate, PDO::PARAM_STR);
        $query->bindParam(':purchaseDate', $purchaseDate, PDO::PARAM_STR);
        $query->bindParam(':seatNumber', $seatNumber, PDO::PARAM_STR);
        $query->execute();
    }

    public static function deleteOccupationById($id)
    {
        try {
            $db = ConnectionDB::getInstance();
            $query = $db->prepare("DELETE FROM occupations WHERE id = :id");
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
    
            if ($query->rowCount() > 0) {
                return json_encode(["success" => "Ocupação excluída com sucesso!"]);
            } else {
                return json_encode(["error" => "Ocupação não encontrada ou já foi excluída."]);
            }
        } catch (Exception $e) {
            return json_encode(["error" => "Erro ao excluir ocupação: " . $e->getMessage()]);
        }
    }


    public static function validateFlight($code)
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

            return json_encode($response);
        } else {
            return json_encode(["error" => "Vôo não encontrado"]);
        }

    }


    public static function validateSeat($flightCode, $seatNumber, $id = null)
    {
        header('Content-Type: application/json');

        $db = ConnectionDB::getInstance();
        $query = $db->prepare("SELECT * FROM occupations WHERE seat_number = :seatNumber AND flight_code = :flightCode");
        $query->bindParam(':seatNumber', $seatNumber, PDO::PARAM_STR);
        $query->bindParam(':flightCode', $flightCode, PDO::PARAM_STR);
        $query->execute();
        $occupation = $query->fetch(PDO::FETCH_OBJ);

        if ($occupation && (!$id || $occupation->id = $id)) {
            return json_encode(["error" => "Assento já ocupado"]);
        } else {
            return json_encode([]);
        }
    }
}
