<?php

    class Plane {
        private $id;
        private $code;
        private $model;
        private $totalSeats;

        function __construct($id ,$code, $model, $totalSeats) {
            $this->id = $id;
            $this->code = $code;
            $this->model = $model;
            $this->totalSeats = $totalSeats;
        }

        function __construct($code, $model, $totalSeats) {
            $this->code = $code;
            $this->model = $model;
            $this->totalSeats = $totalSeats;
        }

        function getCode(){
            return $this->code;
        }

        function getModel(){
            return $this->model;
        }

        function getTotalSeats(){
            return $this->totalSeats;
        }
    }
?>