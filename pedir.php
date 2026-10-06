<?php 

$scripts = ['app']; // JavaScript global
require 'includes/funciones.php';
incluirTemplates('header');
include 'includes/templates/loader.php';


?>

<section class="pedir-hero">
    <div class="pedir-hero-content">
        <p class="pedir-hero-eyebrow">CHEO PARRILLA <span>·</span> SABOR CASERO</p>
        <h1>¡Pide tu <strong>antojo!</strong></h1>
        <p class="pedir-hero-description">Hamburguesas, parrilla y mucho sabor, preparados al momento.</p>
        <a href="#categorias-pedir" class="pedir-hero-action">Explorar categorías <span aria-hidden="true">↓</span></a>
    </div>
    <p class="pedir-hero-note"><span></span> </p>
</section>

<section class="pedir-menu" id="categorias-pedir">
    <div class="pedir-menu-heading">
        <p>¡PIDE AHORA MISMO!</p>
        <h2>¿Qué se te antoja?</h2>
    </div>
    <div class="pedir container">
        <?php include 'includes/templates/pedirCards.php' ?>
    </div>
</section>



</div>
</div>

<?php  include 'includes/templates/footer.php' ?>   

