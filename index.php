<?php
require_once "vendor/autoload.php";

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Request;

Router::get('/', 'HomeController@index');
Router::get('/home', 'HomeController@index');

Router::get('/login', 'LoginController@isLogged');
// Router::post('/login', 'LoginController@login');
Router::post('/login', function () {
    $loginController = new LoginController();
    $username = Router::request()->getInputHandler()->value('username');
    $password = Router::request()->getInputHandler()->value('password');
    $loginController->login($username, $password);
});

Router::get('/logout', 'LogoutController@logout');

Router::get('/signup', 'SignupController@isLogged');
// Router::post('/login', 'LoginController@login');
Router::post('/signup', function () {
    $signupController = new SignupController();
    $username = Router::request()->getInputHandler()->value('username');
    $password = Router::request()->getInputHandler()->value('password');
    $passwordConfirm = Router::request()->getInputHandler()->value('password-confirm');
    $signupController->signup($username, $password, $passwordConfirm);
});

Router::get('/plane', 'PlaneController@getAllPlanes');
Router::get('/plane/list', 'PlaneController@getAllPlanes');
Router::get('/plane/{id}', function ($id) {
    $planeController = new PlaneController();
    $planeController->getPlane($id);
});
Router::post('/plane/save', function () {
    $planeController = new PlaneController();
    $code = Router::request()->getInputHandler()->value('code');
    $model = Router::request()->getInputHandler()->value('model');
    $totalSeats = Router::request()->getInputHandler()->value('totalSeats');
    $id = Router::request()->getInputHandler()->value('id');

    $planeController->save($code, $model, $totalSeats, $id);
});
Router::get('/plane/delete/{id}', function ($id) {
    $planeController = new PlaneController();
    $planeController->deletePlane($id);
});

Router::get('/flight', 'FlightController@getAllFlights');
Router::get('/flight/list', 'FlightController@getAllFlights');
// Router::get('/flight/{id}', 'FlightController@getFlight');
Router::get('/flight/{id}', function ($id) {
    $flightController = new FlightController();
    $flightController->getFlight($id);
});
Router::post('/flight/save', function () {
    $flightController = new FlightController();
    $code = Router::request()->getInputHandler()->value('code');
    $departureDate = Router::request()->getInputHandler()->value('model');
    $departureTime = Router::request()->getInputHandler()->value('departureTime');
    $destination = Router::request()->getInputHandler()->value('destination');
    $ticketPrice = Router::request()->getInputHandler()->value('ticketPrice');
    $id = Router::request()->getInputHandler()->value('id');

    $flightController->save($code, $departureDate, $departureTime, $destination, $ticketPrice, $id);
});
Router::get('/flight/delete/{id}', function ($id) {
    $flightController = new FlightController();
    $flightController->deleteFlight($id);
});


Router::get('/occupation', 'OccupationController@getOccupations');
Router::get('/occupation/list', 'OccupationController@getOccupations');

Router::get('/occupation/{id}', function ($id) {
    $occupationController = new OccupationController();
    $occupationController->getOccupationById($id);
});
Router::get('/occupation/validateFlight/{flightCode}', function ($flightCode) {
    $occupationController = new OccupationController();
    $occupationController->validateFlight($flightCode);
});

Router::get('/occupation/validateSeat/{flightCode}/{seatNumber}/', function ($flightCode, $seatNumber) {
    $occupationController = new OccupationController();
    $occupationController->validateSeat($flightCode, $seatNumber);
});
Router::get('/occupation/validateSeat/{flightCode}/{seatNumber}/{id}', function ($flightCode, $seatNumber, $id) {
    $occupationController = new OccupationController();
    $occupationController->validateSeat($flightCode, $seatNumber, $id);
});

// Router::post('/occupation/save', function () {
//     $occupationController = new OccupationController();
//     $code = Router::request()->getInputHandler()->value('code');
//     $departureDate = Router::request()->getInputHandler()->value('model');
//     $departureTime = Router::request()->getInputHandler()->value('departureTime');
//     $destination = Router::request()->getInputHandler()->value('destination');
//     $ticketPrice = Router::request()->getInputHandler()->value('ticketPrice');
//     $id = Router::request()->getInputHandler()->value('id');

//     //     let flightCode = document.getElementById('flightCode').value;
//     //     let flightDate = document.getElementById('flightDate').value;
//     //     let flightPurchaseDate = document.getElementById('flightPurchaseDate').value;
//     //     let seatNumber = document.getElementById('seatNumber').value;
//     //     let id = document.getElementById('flightId').value;

//     $occupationController->save($code, $departureDate, $departureTime, $destination, $ticketPrice, $id);
// });

Router::post('/occupation/save', function () {
    $occupationController = new OccupationController();

    $flightCode = Router::request()->getInputHandler()->value('flightCode');
    $flightDepartureDate = Router::request()->getInputHandler()->value('flightDepartureDate');
    $purchaseDate = Router::request()->getInputHandler()->value('purchaseDate');
    $seatNumber = Router::request()->getInputHandler()->value('seatNumber');
    $id = Router::request()->getInputHandler()->value('id');

    $occupationController->save($flightCode, $flightDepartureDate, $purchaseDate, $seatNumber, $id);
});


Router::get('/occupation/delete/{id}', function ($id) {
    $occupationController = new OccupationController();
    $occupationController->deleteOccupationById($id);
});


Router::get('/not-found', function () {
    require 'view/layout/404.php';
});
Router::get('/forbidden', function () {
    require 'view/layout/404.php';
});
Router::error(function (Request $request, \Exception $exception) {

    switch ($exception->getCode()) {
        // Page not found
        case 404:
            Router::response()->redirect('/not-found');
            break;
        // Forbidden
        case 403:
            Router::response()->redirect('/forbidden');
            break;
    }

});

Router::start();
// $rota = explode('/', substr($_SERVER['REQUEST_URI'], 1));

// $recurso = empty($rota[0]) ? 'home' : $rota[0];

// $controlador = "controller/$recurso"."Controller.php";

// $acao = empty($rota[1]) ? "list" : $rota[1];

// if (file_exists($controlador)) {
//     require($controlador);
// } else {
//     require("controllers/404Controller.php");
// }