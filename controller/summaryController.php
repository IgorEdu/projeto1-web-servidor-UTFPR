<?php 
require 'vendor/autoload.php';

class SummaryController{

    private array $ticketSummary = array();

    private array $occupationSummary = array();

    function getTicketSaleSummary(){

        if (!CheckAuthenticationService::isLogged()){
            require_once 'view/login.php';
            exit();
        }

        $occupationSummary = SummaryService::getTicketSaleSummary();

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