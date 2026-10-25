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
			<p class="carta-hero__eyebrow" style="margin-top: 70px;">Sabor hecho en casa</p>
			<h1 class ="cheoTransicion" id="carta-title">Nuestra Carta</h1>
			<p class="carta-hero_descripcion">EXPLORA NUESTRAS ESPECIALIDADES Y DESCRUBRE TU PRÓXIMO PLATO FAVORITO.</p>
			<p class="avisoPedir" style="margin-top: 30px;">Este apartado es un menú visual, si quieres pedir ahora dale click al boton de abajo</p>
			<a href="pedir.php" class="btn btn-negro">Pedir Ahora</a>
			
		</div>
	</section>

	<nav class="carta-categorias" aria-label="Categorías de la carta">
		<a href="#asados">Asados y Carnes</a>
		<a href="#hamburguesas">Hamburguesas Artesanales</a>
		<a href="#combos">Combos</a>
		<a href="#salchipapas">Salchipapas</a>
		<a href="#perros">Perros y Perras Artesanales</a>
		<a href="#otros">Otros</a>
		<a href="#bebidas">Bebidas</a>
		<a href="#licores">Licores</a>
	</nav>

<div class="uiv-cards-container">
<?php  include 'includes/templates/cards.php' ?>

    
</div>

<a href="pedir.php">
    <button class="carrito-pedir-launcher-otros" type="button" >
            <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
        </button>
</a>
</main>




<?php include 'includes/templates/footer.php' ?>