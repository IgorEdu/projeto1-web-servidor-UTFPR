<?php
require 'controller/checkAuthenticationController.php';
require_once 'entities/Plane.php';
require_once 'infra/ConnectionDB.php';
require_once 'model/planeService.php';

// $db = ConnectionDB::getInstance();
$planeList = [];


function getAllPlanes(){

    $planeList = findPlaneList();
    return $planeList;
}

function getPlane($id = null){
    try{
        $plane = (object) getPlaneById($id);

        if ($plane) {
            // Retorna um array associativo em vez do objeto diretamente
            $response = [
                "id" => $plane->getId(),
                "code" => $plane->getCode(),
                "model" => $plane->getModel(),
                "totalSeats" => $plane->getTotalSeats()
            ];
            echo json_encode($response);
        } else {
            echo json_encode(null);
        }
    }catch (Exception $e) {
        echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
    }
}

function addPlane(){
    try{
        $code = $_POST['code'];
        $model = $_POST['model'];
        $totalSeats = $_POST['totalSeats'];

        $plane = new Plane($code, $model, $totalSeats);
        insertPlane($plane);

        header('Location: /plane/list');
    }catch (Exception $e) {
        echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
    } 
}

function editPlane(){
    try{
        $id = $_POST['id'];
        $code = $_POST['code'];
        $model = $_POST['model'];
        $totalSeats = $_POST['totalSeats'];

        $plane = new Plane($code, $model, $totalSeats, $id);

        updatePlane($plane);

        header('Location: /plane/list');
    }catch (Exception $e) {
        echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
    } 
}

function deletePlane(){
    try{
        $id = $_GET['id'];
        deletePlaneById($id);
        header('Location: /plane/list');
    }catch (Exception $e) {
        echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
    }   
}

if($acao == 'list'){
    $planeList = getAllPlanes();
}else if($acao == 'getById'){
    getPlane($_GET['id']);
}else if($acao == 'save'){
    if (empty($_POST['id'])) {
        addPlane();
    } else {
        editPlane();
    }
}else if($acao == 'delete'){
    deletePlane();
}

require_once 'views.php';
