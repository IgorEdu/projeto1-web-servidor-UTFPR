<?php

    class TableOccupationSummary {

        private $flightCode;
        private $flightDepartureDate;
        private $seatsOccupied;

        function __construct($flightCode, $flightDepartureDate, $seatsOccupied) {
            $this->flightCode = $flightCode;
            $this->flightDepartureDate = $flightDepartureDate;
            $this->seatsOccupied = $seatsOccupied;
        }

        function getFlightCode(){
            return $this->flightCode;
        }

        public function getFlightDepartureDate(){
            return $this->flightDepartureDate;
        }

        function getSeatsOccupied(){
            return $this->seatsOccupied;
        }

    }
?>