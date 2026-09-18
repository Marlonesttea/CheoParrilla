<?php 

$scripts = ['app', 'contacto']; // global + específico
require 'includes/funciones.php';
incluirTemplates('header');
include 'includes/templates/loader.php';
?>

<div class="reservas-container">
    <h1 id="apartar">Reservas</h1>
    <p id="descripcion">Asegura tu lugar de forma fácil y rápida. Reserva vía WhatsApp y haz de tu visita una experiencia especial.</p>
    <a href="https://wa.me/573234382813?text=Hola,%20quiero%20reservar" class="btn">Reservar Ahora</a>
</div>




































<?php  include 'includes/templates/footer.php' ?>