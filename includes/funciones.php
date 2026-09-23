<?php

function incluirTemplates($nombre): void {
    include __DIR__ ."/templates/$nombre.php";
}

$projectRoot = realpath(__DIR__ . '/..');
$documentRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
$basePath = '/';

if ($projectRoot !== false && $documentRoot !== false) {
    $projectRoot = str_replace('\\', '/', $projectRoot);
    $documentRoot = str_replace('\\', '/', $documentRoot);

    if (strpos($projectRoot, $documentRoot) === 0) {
        $relativePath = trim(substr($projectRoot, strlen($documentRoot)), '/');
        $basePath = $relativePath === '' ? '/' : '/' . $relativePath . '/';
    }
}

define('BASE_URL', $basePath);


function auth() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (($_SESSION['login'] ?? false) !== true) {
        header('Location: ' . BASE_URL . 'admin/login.php');
        exit;
    }
}
