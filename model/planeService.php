<?php
    require_once(__DIR__ . "/../entities/flights.php");
    require_once(__DIR__ . "/../infra/ConnectionDB.php");

    function findPlaneList(){
        try {
            $db = ConnectionDB::getInstance();
            $query = $db->prepare("SELECT * FROM planes");
            $query->execute();
            $dbPlaneList = $query->fetchAll(PDO::FETCH_OBJ);

            $planeList = array();
    
            foreach ($dbPlaneList as $dbPlane) {
                $planeList[] = new Plane($dbPlane->code, $dbPlane->model, $dbPlane->total_seats, $dbPlane->id);
            }

            return $planeList;
        } catch (Exception $e) {
            echo "Erro ao conectar ou buscar dados: " . $e->getMessage();
        }
    }

    function getPlaneById($id){
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("SELECT * FROM planes WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        $dbPlane = $query->fetch(PDO::FETCH_OBJ);

        $plane = new Plane($dbPlane->code, $dbPlane->model, $dbPlane->total_seats, $dbPlane->id);

        return $plane;
    }

    function insertPlane(&$plane){
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("INSERT INTO planes(code, model, total_seats) VALUES(:code, :model, :totalSeats)");
        $query->bindParam(':code', $plane->getCode());
        $query->bindParam(':model', $plane->getModel());
        $query->bindParam(':totalSeats', $plane->gettotalSeats());
        $query->execute();
    }

    function updatePlane(&$plane){

        $db = ConnectionDB::getInstance();
        
        $query = $db->prepare("UPDATE planes SET code = :code, model = :model, total_seats = :totalSeats WHERE id = :id");
        $query->bindParam(':id', $plane->getId());
        $query->bindParam(':code', $plane->getCode());
        $query->bindParam(':model', $plane->getModel());
        $query->bindParam(':totalSeats', $plane->getTotalSeats());
        $query->execute();
    }

    function deletePlaneById($id){
        $db = ConnectionDB::getInstance();
        $query = $db->prepare("DELETE FROM planes WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
    }
    