<?php  

$scripts = ['app', 'contacto']; 

require 'includes/funciones.php'; 
incluirTemplates('header'); 
include 'includes/templates/loader.php'; 

?>


<!-- =====================================================
PRIMERA CARA - PRESENTACIÓN
===================================================== -->

<section class="nosotros-primera-cara">

    <div class="nosotros-presentacion">

        <h1>PASIÓN POR LA PARRILLA Y LA SAZÓN</h1>

        <p>
            Cheo Parrilla, donde cada bocado tiene su propia historia
            y el verdadero sabor de la parrilla se convierte en un
            momento que siempre querrás repetir.
        </p>

    </div>

</section>




<!-- =====================================================
     SEGUNDA CARA - HISTORIA, ENFOQUE Y SAZÓN
     ===================================================== -->

<section class="nosotros-segunda-cara">

    <div class="nosotros-tarjetas">


        <!-- ================= HISTORIA ================= -->

        <div class="nosotros-tarjeta">

            <h2>HISTORIA</h2>

            <div class="nosotros-imagen">
                <img 
                    src="img/PrimeraImagenNosotros.png" 
                    alt="Historia de Cheo Parrilla"
                >
            </div>

            <p>
                Cheo Parrilla nació de un pequeño sueño familiar:
                crear un lugar donde las personas pudieran disfrutar
                de comida rápida preparada con amor y dedicación.
                Con esfuerzo, dedicación y el cariño de sus clientes,
                Cheo Parrilla ha ido creciendo hasta convertirse
                en un espacio para compartir y disfrutar.
            </p>

        </div>



        <!-- ================= ENFOQUE ================= -->

        <div class="nosotros-tarjeta">

            <h2>ENFOQUE</h2>

            <div class="nosotros-imagen">
                <img 
                    src="img/caballoHomosexual.jfif" 

                >
            </div>

            <p>
                En Cheo Parrilla buscamos brindar una experiencia
                agradable, ofreciendo productos de calidad y un
                excelente servicio. Nuestro objetivo es que cada
                cliente pueda disfrutar de un buen momento mientras
                comparte y saborea nuestros platos.
            </p>

        </div>



        <!-- ================= SAZÓN ================= -->

        <div class="nosotros-tarjeta">

            <h2>SAZÓN</h2>

            <div class="nosotros-imagen">
                <img 
                    src="img/sazón.jpg" 
                    alt="Sazón de Cheo Parrilla"
                >
            </div>

            <p>
                Nuestra sazón nace del amor que ponemos en cada plato.
                Utilizamos ingredientes de buena calidad y cuidamos
                cada preparación para conseguir sabores únicos que
                nuestros clientes puedan disfrutar en cada visita.
            </p>

        </div>


    </div>

</section>


<?php include 'includes/templates/footer.php'; ?>