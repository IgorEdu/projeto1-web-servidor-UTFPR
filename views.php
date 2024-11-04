<?php

$recurso = empty($rota[0]) ? 'home' : $rota[0];
$view = "view/$recurso.php";
$acao = empty($rota[1]) ? "list" : $rota[1];

if (in_array($recurso, ["login", "logout", "signup", "home"])) {
    $acao = '';
}

// include('view/layout/header.php');

if ($acao == 'list') {
    $view = "view/$recurso/list-$recurso.php";
} else if ($acao == 'save') {
    $view = "view/$recurso/edit-$recurso.php";
} else if ($acao == 'edit') {
    $view = "view/$recurso/edit-$recurso.php";
} else if ($acao == 'getById'){
    exit;
}

if (file_exists($view)):
    include($view);
else:
    include("view/layout/404.php");
endif;

// include("layout/footer.php");