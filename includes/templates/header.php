<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante CheoParrilla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Conexión a los servidores de Google Fonts -->
<link rel="preconnect" href="https://googleapis.com">
<link rel="preconnect" href="https://gstatic.com" crossorigin>
<link href="https://googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@700;900&family=Montserrat:wght@700;900&family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/app.css">
</head>

<body>
    <!-- navBar -->
    <header class="header">
        <div class="container nav">
            <nav class="nav-group nav-group--left" aria-label="Navegación principal izquierda">
                <a href="<?php echo BASE_URL;?>index.php">Inicio</a>
                <a href="<?php echo BASE_URL;?>index.php#nosotros">Nosotros</a>
                <a href="<?php echo BASE_URL;?>index.php#galeria">Galeria</a>
                <a href="<?php echo BASE_URL;?>menu.php">Menú</a>
            </nav>

            <a href="index.php" class="logo-link">
                <div><img src="img/logoc2.png" class="logo" alt="logo"></div>
            </a>

            <nav class="nav-group nav-group--right" aria-label="Navegación principal derecha">
                <a href="<?php echo BASE_URL;?>index.php#">Pedir Ahora</a>
                <a href="<?php echo BASE_URL;?>index.php#">Reservas</a>
                <a href="<?php echo BASE_URL;?>contacto.php">Contacto</a>
                <a href="<?php echo BASE_URL;?>index.php#redes">Redes</a>
            </nav>

            <button class="nav-toggle" type="button" aria-label="Abrir menú" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="nav-panel" id="nav-panel" aria-hidden="true">
                <nav class="nav-panel-links" aria-label="Menú móvil">
                    <a href="<?php echo BASE_URL;?>index.php">Inicio</a>
                    <a href="<?php echo BASE_URL;?>index.php#nosotros">Nosotros</a>
                    <a href="<?php echo BASE_URL;?>index.php#galeria">Galeria</a>
                    <a href="<?php echo BASE_URL;?>menu.php">Menú</a>
                    <a href="<?php echo BASE_URL;?>index.php#">Pedir Ahora</a>
                    <a href="<?php echo BASE_URL;?>index.php#">Reservas</a>
                    <a href="<?php echo BASE_URL;?>contacto.php">Contacto</a>
                    <a href="<?php echo BASE_URL;?>index.php#redes">Redes</a>
                </nav>
            </div>
        </div>
    </header>