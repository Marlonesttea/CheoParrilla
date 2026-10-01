<?php

function incluirTemplates($nombre): void {
    include __DIR__ ."/templates/$nombre.php";
}


// BASE_URL se calcula solo: compara la carpeta del proyecto con la raíz
// del servidor (DOCUMENT_ROOT), así funciona igual en cualquier PC
// (Windows o Mac) sin importar en qué carpeta tenga cada quien el proyecto.
$raizProyecto = str_replace('\\', '/', dirname(__DIR__));
$raizServidor = str_replace('\\', '/', rtrim($_SERVER['DOCUMENT_ROOT'], '/\\'));

$base = str_replace($raizServidor, '', $raizProyecto);
$base = '/' . trim($base, '/') . '/';
if ($base === '//') {
    $base = '/';
}

define('BASE_URL', $base);

function auth() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (($_SESSION['login'] ?? false) !== true) {
        header('Location: ' . BASE_URL . 'admin/login.php');
        exit;
    }
}
