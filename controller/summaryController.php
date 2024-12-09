<?php 
require 'vendor/autoload.php';

class SummaryController{

    private array $ticketSummary = array();

    private array $occupationSummary = array();

    function getTicketSaleSummary(){

        require_once 'view/summary/ticketSaleSummary.view.php';
    }

    function getOcupationSummary(){

        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        $occupationSummary = SummaryService::getOccupationSummary();

        require_once 'view/summary/ocupationSummary.view.php';
    }
}