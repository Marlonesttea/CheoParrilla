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



<!-- =====================================================
     ESTILOS DE LA PÁGINA NOSOTROS
     ===================================================== -->

<style>

    /* ================================================
       PRIMERA CARA
       ================================================ */

    .nosotros-primera-cara {

        min-height: 100vh;

        background-image:
            linear-gradient(
                rgba(0, 0, 0, 0.45),
                rgba(0, 0, 0, 0.60)
            ),
            url("img/Primeraimagennosotros2.png");

        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

        display: flex;
        justify-content: center;
        align-items: center;

        text-align: center;

        padding: 40px 20px;

        box-sizing: border-box;
    }


    .nosotros-presentacion {

        max-width: 750px;

        color: white;

        padding: 30px;
    }


    .nosotros-presentacion h1 {

        font-size: 28px;

        font-family: Georgia, serif;

        letter-spacing: 1px;

        margin-bottom: 25px;

        text-shadow: 2px 2px 5px black;
    }


    .nosotros-presentacion p {

        font-size: 16px;

        line-height: 1.6;

        margin: 0;

        text-shadow: 1px 1px 4px black;
    }



    /* ================================================
       SEGUNDA CARA
       ================================================ */

    .nosotros-segunda-cara {

        min-height: 100vh;

        background: linear-gradient(
        135deg,
        #030303 0%,
        #181411 50%,
        #000000 100%
    );
    background-attachment: fixed;

        padding: 70px 5%;

        box-sizing: border-box;
    }


    .nosotros-tarjetas {

        width: 100%;

        max-width: 1200px;

        margin: 0 auto;

        display: flex;

        justify-content: center;

        align-items: flex-start;

        gap: 30px;
    }



    /* ================================================
       TARJETAS
       ================================================ */

    .nosotros-tarjeta {

        width: 33.333%;

        text-align: center;

        color: white;
    }


    .nosotros-tarjeta h2 {

        font-family: Georgia, serif;

        font-size: 30px;

        letter-spacing: 2px;

        margin: 0 0 20px 0;

        color: white;
    }


    /* ================================================
       IMÁGENES
       ================================================ */

    .nosotros-imagen {

        width: 100%;

        height: 250px;

        overflow: hidden;

        border-radius: 15px;

        margin-bottom: 20px;
    }


    .nosotros-imagen img {

        width: 100%;

        height: 100%;

        object-fit: cover;

        display: block;
    }


    /* ================================================
       TEXTO DE LAS TARJETAS
       ================================================ */

    .nosotros-tarjeta p {

        font-size: 14px;

        line-height: 1.5;

        color: white;

        margin: 0 auto;

        max-width: 330px;
    }



    /* ================================================
       ADAPTACIÓN PARA CELULARES
       ================================================ */

    @media (max-width: 768px) {

        .nosotros-primera-cara {
            min-height: 80vh;
        }


        .nosotros-presentacion h1 {
            font-size: 22px;
        }


        .nosotros-presentacion p {
            font-size: 14px;
        }


        .nosotros-tarjetas {

            flex-direction: column;

            align-items: center;
        }


        .nosotros-tarjeta {

            width: 90%;

            max-width: 400px;
        }


        .nosotros-segunda-cara {

            padding: 50px 20px;
        }

    }

</style>



<?php 

include 'includes/templates/footer.php'; 

?>