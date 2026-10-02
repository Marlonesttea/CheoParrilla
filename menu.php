<?php 

$scripts = ['app']; // JS global
require 'includes/funciones.php';
incluirTemplates('header');
include 'includes/templates/loader.php';

// include 'includes/templates/header.php';
?>

<main class="carta-page">
	<section class="carta-hero" aria-labelledby="carta-title">
		<div class="carta-hero__overlay"></div>
		<div class="carta-hero__content">
			<p class="carta-hero__eyebrow">Sabor hecho en casa</p>
			<h1 class ="cheoTransicion" id="carta-title">Nuestra Carta</h1>
			<p>Explora nuestras especialidades y encuentra tu próximo plato favorito.</p>
		</div>
	</section>

	<nav class="carta-categorias" aria-label="Categorías de la carta">
		<a href="#asados">Asados y Carnes</a>
		<a href="#hamburguesas">Hamburguesas Artesanales</a>
		<a href="#combo-hamburguesas">Combo de Hamburguesas</a>
		<a href="#salchipapas">Salchipapas</a>
		<a href="#perros">Perros y Perras Artesanales</a>
		<a href="#otros">Otros</a>
		<a href="#bebidas">Bebidas</a>
		<a href="#licores">Licores</a>
	</nav>

<div class="uiv-cards-container">
<?php  include 'includes/templates/cards.php' ?>

    
</div>

<button class="carrito-pedir-launcher" type="button" aria-expanded="false" aria-label="Abrir carrito, 0 productos">
            <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
            <span>Tu carrito</span>
            <span class="carrito-pedir-count" aria-live="polite">0</span>
        </button>
</main>




<?php include 'includes/templates/footer.php' ?>