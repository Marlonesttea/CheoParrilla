<?php 

$scripts = ['app', 'carrusel']; // JS global
require 'includes/funciones.php';
incluirTemplates('header');

// include 'includes/templates/header.php';
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

        <!-- inicia tarejta -->
            <div class="card">
                <img src="imgmenú/images.png" alt="plato1">
                <div class="card-body">
                    <h3>Hamburguesas</h3>
                    <p>Nuestras Hamburguesas artesanales son las mejores de medellin, nuestros precios van desde 11.000$ hasta 22.000$ </p>
                    <span>Miralas todas en nuestro menú</span>
                </div>
            </div>
            <!-- termina tarjeta -->

            <!-- inicia tarejta -->
            <div class="card">
                <img src="imgmenú/images7.png" alt="plato2">
                <div class="card-body">
                    <h3>Salchipapa</h3>
                    <p>Lo mejor en salchipapas y picadas, una calidad excelente y un sabor único </p>
                    <span>Pide nuestras picadas y salchipapas en nuestro menú</span>
                </div>
            </div>
            <!-- termina tarjeta -->

            <!-- inicia tarejta -->
            <div class="card">
                <img src="imgmenú/images10.png" alt="plato3">
                <div class="card-body">
                    <h3>Bebidas</h3>
                    <p> Jugos, gaseosas, bebidas alcoholicas y más </p>
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
        <div class="grid-galeria">
            <img src= "imgmenú/images.png" alt="imagen6">
            <img src="imgmenú/images1.png" alt="imagen6">
            <img src="imgmenú/images2.png" alt="imagen6">
            <img src="imgmenú/images3.png" alt="imagen6">
            <img src="imgmenú/images4.png" alt="imagen6">
            <img src="imgmenú/images5.png" alt="imagen6">
            <img src="imgmenú/images6.png" alt="imagen6">
            <img src="imgmenú/images7.png" alt="imagen6">
            <img src="imgmenú/images8.png" alt="imagen6">
            <img src="imgmenú/images9.png" alt="imagen6">
            <img src="imgmenú/images10.png" alt="imagen6">
            <img src="imgmenú/images11.png" alt="imagen6">

        </div>  
    </section>

<?php include __DIR__ . '/includes/templates/carrusel.php'; ?>


<?php  include 'includes/templates/mouse.php' ?>


<?php  include 'includes/templates/footer.php' ?>
