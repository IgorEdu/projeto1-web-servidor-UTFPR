<?php

    class TableTicketSale {

        private $month;
        private $soldTickets;
        private $totalSum;

        function __construct($month, $soldTickets, $totalSum) {
            $this->month = $month;
            $this->soldTickets = $soldTickets;
            $this->totalSum = $totalSum;
        }

        function getMonth(){
            return $this->month;
        }

        function getSoldTickets(){
            return $this->soldTickets;
        }

        public function getTotalSum(){
            return $this->totalSum;
        }
    }
?>