<?php

$scripts = ['app']; // JS global
require '../includes/funciones.php';
incluirTemplates('header');

// include 'includes/templates/header.php';
?>
<section class="admin-container ">
    <div>
        <h1>Administración</h1>
    </div>

    <div class="container nav-admin">
            <a href="<?php echo BASE_URL; ?>admin/menu/crear.php" class="btn">Crear nuevo plato</a>
            <a href="<?php echo BASE_URL; ?>admin/admin.php" class="btn">Editar plato</a>
    </div>

</section>