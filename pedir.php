<?php 

$scripts = ['app', 'contacto']; // global + específico
require 'includes/funciones.php';
incluirTemplates('header');
include 'includes/templates/loader.php';


?>

<section class="pedir-hero">
        <div class="overlay"></div>
        <div class="pedir-hero-content">
            <h1 class="cheoTransicion">¡Pide ahora!</h1>
            <p>Pide lo que desees desde la comodidad de tu hogar, vía WhatsApp</p>
            <a href="https://wa.me/573234382813?text=Hola,%20quiero%20hacer%20un%20pedidos" class="btn">Realizar Pedido</a>
        </div>
    </section>
    
<div class="pedir">
    <h1> ¡Pide ahora!</h1>
    <p>Pide lo que desees desde la comodidad de tu hogar, vía WhatsApp</p>
    <div class= "btnpedir">
    <a href="https://wa.me/573234382813?text=Hola,%20quiero%20hacer%20un%20pedidos" class="btn">Realizar Pedido</a>




<style>
    body{
        background-image: url('img/114093.png');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        filter: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('img/114093.png');

    }
</style>
    </div>

</div>




<?php  include 'includes/templates/footer.php' ?>