<?php 
    $rota = explode('/', substr($_SERVER['REQUEST_URI'], 1));

    $recurso = empty($rota[0]) ? 'home' : $rota[0];

    $controlador = "controller/$recurso"."Controller.php";
    
    $acao = empty($rota[1]) ? "list" : $rota[1];

    if (file_exists($controlador)) {
        require($controlador);
    } else {
        require("controllers/404Controller.php");
    }