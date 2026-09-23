<?php

function incluirTemplates($nombre): void {
    include __DIR__ ."/templates/$nombre.php";
}


// define('BASE_URL', '/CheoParrilla/'); //windows estudiantes 
// define('BASE_URL', '/upb/blanquizal/CheoParrilla/'); //windows estudiantes 
define('BASE_URL', '/'); //mac


function auth() {
    session_start();

    if (!isset($_SESSION['login'])) {
        header("Location: /admin/login.php");
        exit;
    }
}
