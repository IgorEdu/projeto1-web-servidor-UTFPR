<?php 
    require_once(__DIR__ . "/../model/flightService.php");

    if (empty($_SESSION['logged']) || !$_SESSION['logged']) {
        echo "Usuário não logado. Redirecionando para login...";
        header('Location: /login');
        exit;
    }
    
    $flightList = [];

    function getAllFlights(){

        $flightList = findFlightList();
        return $flightList;
    }

    function getFlight($id = null){
        try{
            $flight = (object) getFlightById($id);

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

    function addFlight(){
        try{
            $code = $_POST['code'];
            $departureDate = $_POST['departureDate'];
            $departureTime = $_POST['departureTime'];
            $destination = $_POST['destination'];
            $ticketPrice = $_POST['ticketPrice'];

            $flight = new Flight($code, $departureDate, $departureTime, $destination, $ticketPrice);

            insertFlight($flight);

            header('Location: /flight/list');
        }catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        } 
    }

    function editFlight(){
        try{
            $id = $_POST['id'];
            $code = $_POST['code'];
            $departureDate = $_POST['departureDate'];
            $departureTime = $_POST['departureTime'];
            $destination = $_POST['destination'];
            $ticketPrice = $_POST['ticketPrice'];

            $flight = new Flight($code, $departureDate, $departureTime, $destination, $ticketPrice, $id);

            updateFlight($flight);

            header('Location: /flight/list');
        }catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        } 
    }

    function deleteFlight(){
        try{
            $id = $_GET['id'];
            deleteFlightById($id);
            header('Location: /flight/list');
        }catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }   
    }

    if($acao == 'list'){
        $flightList = getAllFlights();
    }else if($acao == 'getById'){
        getFlight($_GET['id']);
    }else if($acao == 'save'){
        if (empty($_POST['id'])) {
            addFlight();
        } else {
            editFlight();
        }
    }else if($acao == 'delete'){
        deleteFlight();
    }

    require_once (__DIR__ . '/../views.php');