<?php 
// require 'controller/checkAuthenticationController.php';
// require_once(__DIR__ . "/../model/flightService.php");
require 'vendor/autoload.php';

class FlightController{
    // if (empty($_SESSION['logged']) || !$_SESSION['logged']) {
    //     echo "Usuário não logado. Redirecionando para login...";
    //     header('Location: /login');
    //     exit;
    // }
    
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
            // $flight = (object) getFlightById($id);
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
            // $code = $_POST['code'];
            // $departureDate = $_POST['departureDate'];
            // $departureTime = $_POST['departureTime'];
            // $destination = $_POST['destination'];
            // $ticketPrice = $_POST['ticketPrice'];

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
            // $id = $_POST['id'];
            // $code = $_POST['code'];
            // $departureDate = $_POST['departureDate'];
            // $departureTime = $_POST['departureTime'];
            // $destination = $_POST['destination'];
            // $ticketPrice = $_POST['ticketPrice'];

            $flight = new Flight($code, $departureDate, $departureTime, $destination, $ticketPrice, $id);

            FlightService::updateFlight($flight);

            header('Location: /flight/list');
        }catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        } 

        // require_once (__DIR__ . '/../views.php');
    }

    function deleteFlight($id){
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }
        
        try{
            // $id = $_GET['id'];
            FlightService::deleteFlightById($id);
            header('Location: /flight/list');
        }catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }   

        // require_once (__DIR__ . '/../views.php');
    }

    // if($acao == 'list'){
    //     $flightList = getAllFlights();
    // }else if($acao == 'getById'){
    //     getFlight($_GET['id']);
    // }else if($acao == 'save'){
    //     if (empty($_POST['id'])) {
    //         addFlight();
    //     } else {
    //         editFlight();
    //     }
    // }else if($acao == 'delete'){
    //     deleteFlight();
    // }

    // require_once (__DIR__ . '/../views.php');
}
