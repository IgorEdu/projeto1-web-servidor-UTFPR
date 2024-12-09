<?php 
require 'vendor/autoload.php';

class FlightController{
    
    private array $flightList = array();

    function getAllFlights(){
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        $flightList = FlightService::findFlightList();
        require_once 'view/flight/list-flight.php';
    }

    function getFlight($id = null){
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        try{
            $flight = FlightService::getFlightById($id);

            if ($flight) {
                // Retorna um array associativo em vez do objeto diretamente
                $response = [
                    "id" => $flight->getId(),
                    "code" => $flight->getCode(),
                    "departureDate" => $flight->getDepartureDate(),
                    "departureTime" => $flight->getDepartureTime(),
                    "destination" => $flight->getDestination(),
                    "ticketPrice" => $flight->getTicketPrice()
                ];
                echo json_encode($response);
            } else {
                echo json_encode(null); // Ocupação não encontrada
            }
        }catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    public function save($code, $departureDate, $departureTime, $destination, $ticketPrice, $id)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        try {
            if (empty($id)) {
                $this->addFlight($code, $departureDate, $departureTime, $destination, $ticketPrice);
            } else {
                $this->editFlight($id, $code, $departureDate, $departureTime, $destination, $ticketPrice);
            }
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    function addFlight($code, $departureDate, $departureTime, $destination, $ticketPrice){
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        try{
            $flight = new Flight($code, $departureDate, $departureTime, $destination, $ticketPrice);

            FlightService::insertFlight($flight);

            header('Location: /flight/list');
        }catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        } 
    }

    function editFlight($id, $code, $departureDate, $departureTime, $destination, $ticketPrice){
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }
        
        try{

            $flight = new Flight($code, $departureDate, $departureTime, $destination, $ticketPrice, $id);

            FlightService::updateFlight($flight);

            header('Location: /flight/list');
        }catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        } 
    }

    function deleteFlight($id){
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }
        
        try{
            FlightService::deleteFlightById($id);
            header('Location: /flight/list');
        }catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }   
    }

}
