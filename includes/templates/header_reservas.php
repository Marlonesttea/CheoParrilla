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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $raiz ?>/reservas/css/reservas.css">
</head>
<body class="rsv-page">

<header class="rsv-header">
    <a href="<?= $raiz ?>/index.php" class="rsv-marca">Cheo Parrilla</a>
    <a href="<?= $raiz ?>/index.php" class="link-fueguito">&lsaquo; Volver al sitio</a>
</header>

<main class="rsv-main">
