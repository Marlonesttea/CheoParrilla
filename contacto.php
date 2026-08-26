<?php 

$scripts = ['app', 'contacto']; // global + específico
require 'includes/funciones.php';
incluirTemplates('header');

// include 'includes/templates/header.php';

?>

    <section class="prueba container contacto ">
        <h1 id= principal> Contáctanos</h1>
        <p id =subtitulo >Déjanos tu mensaje y te responderemos pronto</p>

        <form class="formulario">
            <div class="fila">
                <div class="campo">
                    <label for="nombre">Nombre<span>*</span></label>
                    <input type="text" 
                    id="nombre" 
                    placeholder="Tu nombre"
                    
                    >
                </div>

                <div class="campo">
                    <label for="apellido">Apellido<span>*</span></label>
                    <input type="text" 
                    id="apellido" 
                    placeholder="Tu apellido" 
                    >
                </div>
            </div>

            <div class="fila">
                <div class="campo">
                    <label for="celular">Celular<span>*</span></label>
                    <input type="tel" 
                    id="celular" 
                    placeholder="Ej 3001243567">
                </div>
                <div class="campo">
                    <label for="email">Email<span></span></label>
                    <input type="email" 
                    id="email" 
                    placeholder="correo@email.com"
                    >
                </div>
            </div>
           
            <div class="campo">
                <label for="mensaje">Mensaje<span>*</span></label>
                <textarea name="mensaje" 
                id="mensaje"
                rows="5"
                placeholder="Escriba tu mensaje..."
                >
                </textarea>
            </div>

            <button type="submit" class="btn-enviar">Enviar Mensaje</button>
            <a href="ReservarMesa.php" class="btn-enviar1"> ReservarMesa</a>

            
        </form>
    </section>


        <?php  include 'includes/templates/footer.php' ?>