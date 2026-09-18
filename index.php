<?php 

$scripts = ['app', 'carrusel']; // JS global
require 'includes/funciones.php';
incluirTemplates('header');
include 'includes/templates/loader.php';

?>

    <!-- hero    -->
    <section class="hero">
        <div class="overlay"></div>
        <img src="img/logoc.png" class="hero-logo" alt="logo">
        <div class="hero-content">
            <h1 class="cheoTransicion">CheoParrilla</h1>
            <p>Hamburguesas artesanales y algo más...</p>
            <h4>Cheo Parrilla es el lugar ideal para disfrutar del auténtico sabor de la parrilla. Ubicado en el Barrio Blanquizal, ofrece una amplia variedad de hamburguesas, carnes, picadas y más, preparados con ingredientes de alta calidad y el mejor sabor. Un espacio pensado para compartir en familia o con amigos, donde cada plato se convierte en una experiencia deliciosa. </h4>
            <a href="menu.php" class="btn">Menú</a>
            <a href="#menu" class="btn">Pedir a domicilio</a>
            <a href="#menu" class="btn">Reservar mesa</a>
            
        </div>
    </section>



    <section class="menu container" id="menu">
        <h2>Nuestros platos</h2>
        <hr class="divisor-linea" style="margin-top: 0px;">
        <div class="cards">

        <!-- inicia tarjeta -->
            <a class="card-link" href="menu.php#asados">
            <div class="card" style="margin-bottom: 25px;"> 
                <img src="img/carnes-menu.png" alt="Carne-menu">
                <div class="card-body">
                    <h3 class="carrusel-name" id="nombre-corto">Asados y Carnes</h3>
                    <p>Clic para ir al menú. </p>
                    
                </div>
            </div>
            </a>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <a class="card-link" href="menu.php#hamburguesas">
            <div class="card" style="margin-bottom: 25px;">
                <img src="img/hamburguesa-menu.png" alt="Hamburguesa_Menu">
                <div class="card-body">
                    <h3 class="carrusel-name">Hamburguesas Artesanales</h3>
                    <p>Clic para ir al menú.</p>
            
                </div>
            </div>
            </a>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <a class="card-link" href="menu.php#combo-hamburguesas">
            <div class="card" style="margin-bottom: 25px;">
                <img src="img/combos-menu.png" alt="Combo_Hamburguesas">
                <div class="card-body">
                    <h3 class="carrusel-name">Combo de Hamburguesas</h3>
                    <p>Clic para ir al menú.</p>
                    
                </div>
            </div>
            </a>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <a class="card-link" href="menu.php#salchipapa">
            <div class="card" style="margin-bottom: 25px;">
                <img src="" alt="">
                <div class="card-body">
                    <h3 class="carrusel-name" id="nombre-corto">Salchipapas</h3>
                    <p>Clic para ir al menú.</p>
                    
                </div>
            </div>
            </a>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <a class="card-link" href="menu.php#perros">
            <div class="card" style="margin-bottom: 25px;">
                <img src="img/perros-menu.png" alt="Perros_Menu">
                <div class="card-body">
                    <h3 class="carrusel-name">Perros y Perras Artesanales</h3>
                    <p>Clic para ir al menú.</p>
                    
                </div>
            </div>
            </a>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <a class="card-link" href="menu.php">
            <div class="card" style="margin-bottom: 25px;">
                <img src="" alt="">
                <div class="card-body">
                    <h3 class="carrusel-name" id="nombre-corto">Bebidas</h3>
                    <p>Clic para ir al menú.</p>
                    
                </div>
            </div>
            </a>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <a class="card-link" href="menu.php">
            <div class="card" style="margin-bottom: 25px;">
                <img src="" alt="">
                <div class="card-body">
                    <h3 class="carrusel-name" id="nombre-corto">Licores</h3>
                    <p>Clic para ir al menú.</p>
                    
                </div>
            </div>
            </a>
            <!-- termina tarjeta -->
        


        </div>

        <hr class="divisor-linea">
    </section>

    <section class="promocion container" id="promocion">
        <h2>2x1 Todos los martes</h2>
        <div class="promocion-content">
            <img src="img/promo1.png" alt="promocion">
            <div class="promocion-text">
                <p> </p>
            </div>
        </div>
    </section>

    <section class="galeria container" id="galeria">
        <h2>Galería</h2>

        <?php include __DIR__ . '/includes/templates/carrusel.php'; ?>

        
        </div>  
    </section>



<?php  include 'includes/templates/mouse.php' ?>


<?php  include 'includes/templates/footer.php' ?>

