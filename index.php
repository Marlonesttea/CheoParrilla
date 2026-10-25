<?php 

$scripts = ['app', 'carrusel']; // JS global
require 'includes/funciones.php';
incluirTemplates('header');
include 'includes/templates/loader.php';

?>

    <!-- hero    -->
    <section class="hero">
        <video class="hero-video" autoplay muted loop playsinline aria-hidden="true">
            <source src="video/videoHero2.mp4" type="video/mp4">
        </video>
        <div class="overlay"></div>
        <img src="img/logoc.png" class="hero-logo" alt="logo">
        <div class="hero-content">
            <h1 class="cheoTransicion">CheoParrilla</h1>
            <p>Hamburguesas artesanales y algo más...</p>
            <h4>Cheo Parrilla es el lugar ideal para disfrutar del auténtico sabor de la parrilla. Ubicado en el Barrio Blanquizal, ofrece una amplia variedad de hamburguesas, carnes, picadas y más, preparados con ingredientes de alta calidad y el mejor sabor. Un espacio pensado para compartir en familia o con amigos, donde cada plato se convierte en una experiencia deliciosa. </h4>
            <a href="menu.php" class="btn">Menú</a>
            <a href="pedir.php" class="btn">Pedir a domicilio</a>
            <a href="reservas/index.php" class="btn">Reservar mesa</a>
            
        </div>
    </section>



    <section class="menu container" id="menu">
        <h2>" Nuestros platos "</h2>
        <hr class="divisor-linea" style="margin-top: 0px;">
        <div class="cards">

            <div class="card" style="margin-bottom: 25px;">
                <img src="img/carnes-menu.png" alt="Carne-menu">
                <div class="card-body">
                    <h3 class="carrusel-name" id="nombre-corto">Asados y Carnes</h3>
                    <p>Explora o pide esta categoría.</p>
                    <div class="acciones-tarjeta">
                        <a class="enlace-tarjeta" href="menu.php#asados">Ver menú</a>
                        <a class="enlace-tarjeta enlace-tarjeta--pedido" href="pedir.php#asadoPedir">Pedir</a>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom: 25px;">
                <img src="img/hamburguesa-menu.png" alt="Hamburguesa_Menu">
                <div class="card-body">
                    <h3 class="carrusel-name">Hamburguesas Artesanales</h3>
                    <p>Explora o pide esta categoría.</p>
                    <div class="acciones-tarjeta">
                        <a class="enlace-tarjeta" href="menu.php#hamburguesas">Ver menú</a>
                        <a class="enlace-tarjeta enlace-tarjeta--pedido" href="pedir.php#hamburPedir">Pedir</a>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom: 25px;">
                <img src="img/combos-menu.png" alt="Combos">
                <div class="card-body">
                    <h3 class="carrusel-name">Combos</h3>
                    <p>Explora o pide esta categoría.</p>
                    <div class="acciones-tarjeta">
                        <a class="enlace-tarjeta" href="menu.php#combos">Ver menú</a>
                        <a class="enlace-tarjeta enlace-tarjeta--pedido" href="pedir.php#combosPedir">Pedir</a>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom: 25px;">
                <img src="img/salchipapas-menu.png" alt="Salchipapa_Menu">
                <div class="card-body">
                    <h3 class="carrusel-name" id="nombre-corto">Salchipapas</h3>
                    <p>Explora o pide esta categoría.</p>
                    <div class="acciones-tarjeta">
                        <a class="enlace-tarjeta" href="menu.php#salchipapas">Ver menú</a>
                        <a class="enlace-tarjeta enlace-tarjeta--pedido" href="pedir.php#salchiPedir">Pedir</a>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom: 25px;">
                <img src="img/perros-menu.png" alt="Perros_Menu">
                <div class="card-body">
                    <h3 class="carrusel-name">Perros y Perras Artesanales</h3>
                    <p>Explora o pide esta categoría.</p>
                    <div class="acciones-tarjeta">
                        <a class="enlace-tarjeta" href="menu.php#perros">Ver menú</a>
                        <a class="enlace-tarjeta enlace-tarjeta--pedido" href="pedir.php#perrosperrasPedir">Pedir</a>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom: 25px;">
                <img src="img/bebidas-menu.png" alt="bebidas_Menu">
                <div class="card-body">
                    <h3 class="carrusel-name" id="nombre-corto">Bebidas</h3>
                    <p>Explora o pide esta categoría.</p>
                    <div class="acciones-tarjeta">
                        <a class="enlace-tarjeta" href="menu.php#bebidas">Ver menú</a>
                        <a class="enlace-tarjeta enlace-tarjeta--pedido" href="pedir.php#bebidasPedir">Pedir</a>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom: 25px;">
                <img src="img/licores-menu.png" alt="Licores_Menu">
                <div class="card-body">
                    <h3 class="carrusel-name" id="nombre-corto">Licores</h3>
                    <p>Explora o pide esta categoría.</p>
                    <div class="acciones-tarjeta">
                        <a class="enlace-tarjeta" href="menu.php#licores">Ver menú</a>
                        <a class="enlace-tarjeta enlace-tarjeta--pedido" href="pedir.php#licoresPedir">Pedir</a>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom: 25px;">
                <img src="img/otros-menu.png" alt="Otros_Menu">
                <div class="card-body">
                    <h3 class="carrusel-name" id="nombre-corto">Otros</h3>
                    <p>Explora o pide esta categoría.</p>
                    <div class="acciones-tarjeta">
                        <a class="enlace-tarjeta" href="menu.php#otros">Ver menú</a>
                        <a class="enlace-tarjeta enlace-tarjeta--pedido" href="pedir.php#otrosPedir">Pedir</a>
                    </div>
                </div>
            </div>

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

<a href="pedir.php">
    <button class="carrito-pedir-launcher-otros" type="button" >
            <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
        </button>
</a>

<?php include 'includes/templates/mouse.php' ?>

<?php  include 'includes/templates/footer.php' ?>

