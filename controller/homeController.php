<?php 

class HomeController{
    public function index(){
        if (CheckAuthenticationService::isLogged()) {
            require_once 'view/home.php';
        } else {
            require_once 'view/login.php';
        }
    }
}