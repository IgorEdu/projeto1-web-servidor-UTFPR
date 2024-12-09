<?php

    class Occupation {
        private $id;
        private $flightId;
        private $purchaseDate;
        private $seatNumber;

        function __construct($flightId, $purchaseDate, $seatNumber, $id = null) {
            $this->id = $id;
            $this->flightId = $flightId;
            $this->purchaseDate = $purchaseDate;
            $this->seatNumber = $seatNumber;
        }

        function getId(){
            return $this->id;
        }

        public function getFlightId(){
            return $this->flightId;
        }

        function getPurchaseDate(){
            return $this->purchaseDate;
        }

        function getSeatNumber(){
            return $this->seatNumber;
        }

    }
?>