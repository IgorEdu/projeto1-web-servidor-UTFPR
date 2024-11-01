<?php
    session_start();
    $usersMock = $_SESSION['usersMock'] ?? [["admin", "123456"],["fulano", "senhaforte"], ["teste", "senha"]];

    if(empty($_SESSION['usersMock'])){
        $_SESSION['usersMock'] = $usersMock;
    }
    

    // function userExists($user){
    //     global $usersMock;
    //     foreach($usersMock as $u){
    //         if($u[0] == $user){
    //             return true;
    //         }
    //     }
    //     return false;
    // }
    