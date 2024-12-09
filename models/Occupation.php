<?php

    class Occupation {
        private $id;
        private $flightCode;
        private $flightDepartureDate;
        private $purchaseDate;
        private $seatNumber;

        function __construct($flightCode, $flightDepartureDate, $purchaseDate, $seatNumber, $id = null) {
            $this->id = $id;
            $this->flightCode = $flightCode;
            $this->flightDepartureDate = $flightDepartureDate;
            $this->purchaseDate = $purchaseDate;
            $this->seatNumber = $seatNumber;
        }

        function getId(){
            return $this->id;
        }

        function getFlightCode(){
            return $this->flightCode;
        }

        function getFlightDepartureDate(){
            return $this->flightDepartureDate;
        }

        function getPurchaseDate(){
            return $this->purchaseDate;
        }

        function getSeatNumber(){
            return $this->seatNumber;
        }

    }
?>