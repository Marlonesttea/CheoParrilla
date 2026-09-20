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
    session_start();

    if (!isset($_SESSION['login'])) {
        header("Location: /admin/login.php");
        exit;
    }
}
