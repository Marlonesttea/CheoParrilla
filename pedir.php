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

<div class="pedir container">
    <?php  include 'includes/templates/PedirCards.php' ?>
</div>




<?php  include 'includes/templates/footer.php' ?>