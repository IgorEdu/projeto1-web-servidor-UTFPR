<?php
    class Flight {
        private $id;
        private $code;
        private $departureDate;
        private $departureTime;
        private $destination;
        private $ticketPrice;

        function __construct($code, $departureDate, $departureTime, $destination, $ticketPrice, $id = null) {
            $this->id = $id;
            $this->code = $code;
            $this->departureDate = $departureDate;
            $this->departureTime = $departureTime;
            $this->destination = $destination;
            $this->ticketPrice = $ticketPrice;
        }

        function getId(){
            return $this->id;
        }

        function getCode(){
            return $this->code;
        }

        function getDepartureDate(){
            return $this->departureDate;
        }

        function getDepartureTime(){
            return $this->departureTime;
        }

        function getDestination(){
            return $this->destination;
        }

        function getTicketPrice(){
            return $this->ticketPrice;
        }
    }
?>