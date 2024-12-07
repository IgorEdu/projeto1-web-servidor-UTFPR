<?php
    require_once(__DIR__ . "/../entities/flights.php");
    require_once(__DIR__ . "/../infra/ConnectionDB.php");

    function findFlightList(){
        try {
            $db = ConnectionDB::getInstance();
            $query = $db->prepare("SELECT * FROM flights");
            $query->execute();
            $dbFlightList = $query->fetchAll(PDO::FETCH_OBJ);

            $flightList = array();
    
            foreach ($dbFlightList as $dbFlight) {
                $flightList[] = new Flight($dbFlight->code, $dbFlight->departure_date, $dbFlight->departure_time, $dbFlight->destination, $dbFlight->ticket_price, $dbFlight->id);
            }

            return $flightList;
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    function getFlightById($id){
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("SELECT * FROM flights WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $dbFlight = $query->fetch(PDO::FETCH_OBJ);

        $flight = new Flight($dbFlight->code, $dbFlight->departure_date, $dbFlight->departure_time, $dbFlight->destination, $dbFlight->ticket_price, $dbFlight->id);

        return $flight;
    }

    function insertFlight(&$flight){

        $db = ConnectionDB::getInstance();
        $query = $db->prepare("INSERT INTO flights(code, departure_date, departure_time, destination, ticket_price) VALUES(:code, :departureDate, :departureTime, :destination, :ticketPrice)");
        $query->bindParam(':code', $flight->getCode());
        $query->bindParam(':departureDate', $flight->getDepartureDate());
        $query->bindParam(':departureTime', $flight->getDepartureTime());
        $query->bindParam(':destination', $flight->getDestination());
        $query->bindParam(':ticketPrice', $flight->getTicketPrice());
        $query->execute();
    }

    function updateFlight(&$flight){

        $db = ConnectionDB::getInstance();
        $query = $db->prepare("UPDATE flights SET code = :code, departure_date = :departureDate, departure_time = :departureTime, destination = :destination, ticket_price = :ticketPrice WHERE id = :id");
        $query->bindParam(':id', $flight->getId());
        $query->bindParam(':code', $flight->getCode());
        $query->bindParam(':departureDate', $flight->getDepartureDate());
        $query->bindParam(':departureTime', $flight->getDepartureTime());
        $query->bindParam(':destination', $flight->getDestination());
        $query->bindParam(':ticketPrice', $flight->getTicketPrice());
        $query->execute();
    }

    function deleteFlightById($id){
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("DELETE FROM flights WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
    }
    