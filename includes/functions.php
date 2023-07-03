<?php

require_once 'app.php';

function includeTemplate(string $page, bool $start = false) {
    include_once TEMPLATES_URL."/{$page}.php";
}

function is_Authenticated() : bool{

    if (!$_SESSION){
        session_start();
    }
   
   return  $_SESSION['login'] ?  true : false;
}