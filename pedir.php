<?php 

$scripts = ['app', 'contacto']; // global + específico
require 'includes/funciones.php';
incluirTemplates('header');
include 'includes/templates/loader.php';


?>
<div class="pedir">
    <h1> ¡Pide ahora!</h1>
    <p>Pide lo que desees desde la comodidad de tu hogar, vía WhatsApp</p>
    <div>
    <a href="https://wa.me/573234382813?text=Hola,%20quiero%20hacer%20un%20pedidos" class="btn">Realizar Pedido</a>
    </div>
</div>

<body>
    <img src="img/111453.jpg" alt="imgpedir">
</body>
<?php  include 'includes/templates/footer.php' ?>