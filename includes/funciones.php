<?php

require 'app.php';

function incluirTemplates(string $nombre, bool $inicio = false) {

    include TEMPLATE_URL . "/${nombre}.php";
};

function estaAuthenticado() : bool{
    session_start();
    $auth = $_SESSION['login'];
    if($auth){
        return true; 
    }
    return false;
    
}
?>