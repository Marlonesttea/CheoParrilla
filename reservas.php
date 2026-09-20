<?php 

$scripts = ['app', 'contacto']; // global + específico
require 'includes/funciones.php';
incluirTemplates('header');
include 'includes/templates/loader.php';
?>

<section class="reservas-container container">
    <img src="img/fondoReser.png" alt="reservas">
    <h1 id="preReservas">Reservas</h1>
    <p id="descripcionReservas">Reserva con nosotros y asegura tu lugar en Cheo Parrilla BBQ.</p>

    <form class="reservas-formulario">
        <div class="campo" style="margin-top: 50px;">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre1" name="nombre" required>
        </div>
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha"textarea  required>

        </div>
        <div class="campo" style="margin-top: 50px;">
            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required>
        </div>
        <div class="campo" style="margin-top: 50px;">
            <label for="personas">Número de personas:</label>
            <input type="number" id="personas" name="personas" min="1" required>
        </div>
        <div class="campo" style="margin-top: 50px;">
            <label for="Datos">Datos Adicionales</label>
            <input type="text" id="Datos" name="Datos" placeholder="Escriba datos adicionales" required>

        </div>

        <button type="submit" class="botonRes">Reservar</button>

    </form>

</section>




































<?php  include 'includes/templates/footer.php' ?>