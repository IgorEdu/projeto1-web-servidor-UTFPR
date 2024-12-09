<?php
// require 'controller/checkAuthenticationController.php';
// require_once 'entities/Plane.php';
// require_once 'infra/ConnectionDB.php';
// require_once 'model/planeService.php';
require 'vendor/autoload.php';


// $db = ConnectionDB::getInstance();

class PlaneController
{

    private array $planeList = array();


    public function getAllPlanes()
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        $planeList =  PlaneService::findPlaneList();

        require_once 'view/plane/list-plane.php';

        // return $planeList;
    }

    public function getPlane($id)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        try {
            $plane = PlaneService::getPlaneById($id);

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
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    public function save($code, $model, $totalSeats, $id)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        try {
            if (empty($id)) {
                $this->addPlane($code, $model, $totalSeats);
            } else {
                $this->editPlane($id, $code, $model, $totalSeats);
            }
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    function addPlane($code, $model, $totalSeats)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        try {
            // $code = $_POST['code'];
            // $model = $_POST['model'];
            // $totalSeats = $_POST['totalSeats'];

            $plane = new Plane($code, $model, $totalSeats);
            PlaneService::insertPlane($plane);

            header('Location: /plane/list');
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    function editPlane($id, $code, $model, $totalSeats)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        try {
            // $id = $_POST['id'];
            // $code = $_POST['code'];
            // $model = $_POST['model'];
            // $totalSeats = $_POST['totalSeats'];

            $plane = new Plane($code, $model, $totalSeats, $id);

            PlaneService::updatePlane($plane);

            header('Location: /plane/list');
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    public function deletePlane($id)
    {
        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }
        
        try {
            // $id = $_GET['id'];
            PlaneService::deletePlaneById($id);
            header('Location: /plane/list');
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    // if($acao == 'list'){
//     $planeList = getAllPlanes();
// }else if($acao == 'getById'){
//     getPlane($_GET['id']);
// }else if($acao == 'save'){
//     if (empty($_POST['id'])) {
//         addPlane();
//     } else {
//         editPlane();
//     }
// }else if($acao == 'delete'){
//     deletePlane();
// }

    // require_once 'views.php';
}
