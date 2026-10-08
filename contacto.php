<?php 

$scripts = ['app', 'contacto']; // global + específico
require 'includes/funciones.php';
require_once __DIR__ . '/includes/agenda_reservas.php';
$whatsapp = cfg(conectarDB(), 'whatsapp', '573234382813');
incluirTemplates('header');
include 'includes/templates/loader.php';


?>


    <section class="container contacto-layout">
        <div class="contacto-panel">
            <div class="contacto-info">
                <p class="subtitulo">ESTAMOS PARA ESCUCHARTE</p>
                <h2>Contáctanos</h2>
                <p class="intro">Déjanos un mensaje sobre cualquier inquietud o experiencia que quieras compartir.</p>

                <div class="contact-list">
                    <div class="contact-item">
                        <span class="icon">📍</span>
                        <p>Calle 58 #92A - 126 <br> Medellin, Colombia</p>
                    </div>
                    <div class="contact-item">
                        <span class="icon">🕒</span>
                        <p>Abrimos a las 4:00 pm <br> Cerramos a las 12:00 am</p>
                    </div>
                </div>

                <div class="horario-descanso">
                    <span class="horario-descanso__label">Aviso</span> <br>
                    <p><strong>Lunes:</strong> no hay servicio.</p>
                </div>
            </div>

            <div class="contacto-form-wrapper">
                <h3>Tus Datos</h3>
                <p class="form-subtitle">Completa tus datos y cuéntanos cómo podemos ayudarte.</p>

                <form class="formulario contacto-form" data-whatsapp="<?= limpiar($whatsapp) ?>">
                    <div class="fila">
                        <div class="campo">
                            <label for="nombre">Nombre y Apellido<span>*</span></label>
                            <input type="text" id="nombre" name="nombre" placeholder="Carlos Medina" required>
                        </div>

                        <div class="campo">
                            <label for="celular">Teléfono<span>*</span></label>
                            <input type="tel" id="celular" name="celular" placeholder="312 123 4567" required>
                        </div>
                    </div>

                    <div class="campo campo-full">
                        <label for="situacion">Tipo de situación.<span>*</span></label>
                        <select id="situacion" name="situacion" required>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="Pimcompleto">Pedido incompleto</option>
                             <option value="Pincorrecto">Pedido incorrecto</option>
                            <option value="ComiME">Comida en mal estado</option>
                             <option value="ComiFri">Comida fría</option>
                              <option value="ProHi">Problema de higiene</option>
                               <option value="Demo">Demora en la entrega</option>
                                <option value="MalPe">Mala atención por parte del personal</option>
                                 <option value="ErrorCo">Error en el cobro</option>
                                  <option value="ProbleReserva">Problema con la reserva</option>
                                   <option value="AmbienInco">Ambiente incómodo</option>
                                   <option value="Sugerencia">Sugerencia</option>
                                   <option value="Felicitación">Felicitación</option>
                                   <option value="Otro">Otro</option>
                        </select>
                    </div>

                    <div class="campo campo-full">
                        <label for="mensaje">Mensaje<span>*</span></label>
                        <textarea name="mensaje" id="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
                    </div>

                    <button type="submit" class="btn-enviar">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </section>
    
     <?php  include 'includes/templates/footer.php' ?>