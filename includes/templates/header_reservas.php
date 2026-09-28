<?php
/* Cabecera propia del modulo.
   No usa BASE_URL a proposito: todas las rutas son relativas, asi
   el modulo funciona este donde este la carpeta del proyecto. */
$titulo = $titulo ?? 'Reservas';
$raiz   = $raiz   ?? '..';      // ruta para volver al sitio principal
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= limpiar($titulo) ?> | Cheo Parrilla</title>
    <link rel="stylesheet" href="<?= $raiz ?>/reservas/css/reservas.css">
</head>
<body class="rsv-page">

<header class="rsv-header">
    <a href="<?= $raiz ?>/index.php" class="rsv-marca">Cheo Parrilla</a>
    <a href="<?= $raiz ?>/index.php" class="rsv-volver">&lsaquo; Volver al sitio</a>
</header>

<main class="rsv-main">
