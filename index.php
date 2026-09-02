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
        <div class="cards">

        <!-- inicia tarjeta -->
            <div class="card">
                <img src="" alt="">
                <div class="card-body">
                    <h3>Asados y Carnes</h3>
                    <p>Texto... </p>
                    <span>Miralas todas en nuestro menú</span>
                </div>
            </div>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <div class="card">
                <img src="" alt="">
                <div class="card-body">
                    <h3>Hamburguesas Artesanales</h3>
                    <p>Texto...</p>
                    <span>Pide nuestras picadas y salchipapas en nuestro menú</span>
                </div>
            </div>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <div class="card">
                <img src="" alt="">
                <div class="card-body">
                    <h3>Combo de Hamburguesas</h3>
                    <p>Texto...</p>
                    <span> Encuentralas en nuestro menú </span>
                </div>
            </div>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <div class="card">
                <img src="" alt="">
                <div class="card-body">
                    <h3>Salchipapas</h3>
                    <p>Texto...</p>
                    <span>Miralas todas en nuestro menú</span>
                </div>
            </div>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <div class="card">
                <img src="" alt="">
                <div class="card-body">
                    <h3>Perros y Perras Artesanales</h3>
                    <p>Texto...</p>
                    <span>Pide nuestras picadas y salchipapas en nuestro menú</span>
                </div>
            </div>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <div class="card">
                <img src="" alt="">
                <div class="card-body">
                    <h3>Bebidas</h3>
                    <p>Texto...</p>
                    <span> Encuentralas en nuestro menú </span>
                </div>
            </div>
            <!-- termina tarjeta -->

            <!-- inicia tarjeta -->
            <div class="card">
                <img src="" alt="">
                <div class="card-body">
                    <h3>Licores</h3>
                    <p>Texto...</p>
                    <span> Encuentralas en nuestro menú </span>
                </div>
            </div>
            <!-- termina tarjeta -->



        </div>
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
