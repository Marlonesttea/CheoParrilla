<?php

function incluirTemplates($nombre): void {
    include __DIR__ ."/templates/$nombre.php";
}


define('BASE_URL', '/CheoParrilla/'); //windows estudiantes 
// define('BASE_URL', '/upb/blanquizal/CheoParrilla/'); //windows estudiantes 
// define('BASE_URL', '/'); //mac

function auth() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (($_SESSION['login'] ?? false) !== true) {
        header('Location: ' . BASE_URL . 'admin/login.php');
        exit;
    }
}
