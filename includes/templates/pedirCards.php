<?php
require_once __DIR__ . '/../funciones.php';
require_once __DIR__ . '/../config/database.php';

$db = conectarDB();
$categorias = obtenerCategoriasConPlatos($db);
$idsCategoria = [
    'asados' => 'asadoPedir',
    'hamburguesas' => 'hamburPedir',
    'combo-hamburguesas' => 'combohambPedir',
    'salchipapas' => 'salchiPedir',
    'perros' => 'perrosperrasPedir',
    'otros' => 'otrosPedir',
    'bebidas' => 'bebidasPedir',
    'licores' => 'licoresPedir',
];
?>
<div class="card-container-pedir">
  <template class="categoria-pedir-panel-heading-template">
    <header class="categoria-pedir-panel-heading">
      <h2></h2>
      <p>Cartas</p>
    </header>
  </template>

  <?php foreach ($categorias as $categoria):
      $slug = (string) $categoria['slug'];
      $categoriaId = $idsCategoria[$slug] ?? 'categoria-' . preg_replace('/[^a-z0-9-]/', '', strtolower($slug));
  ?>
  <div class="categoria-pedir" id="<?= htmlspecialchars($categoriaId, ENT_QUOTES, 'UTF-8') ?>">
    <div class="barra-pedir"><h2><?= htmlspecialchars($categoria['nombre'], ENT_QUOTES, 'UTF-8') ?></h2></div>
  </div>

  <?php foreach ($categoria['platos'] as $plato):
      $imagen = trim((string) $plato['imagen']);
      $esClaseImagen = (bool) preg_match('/^imagenCards\d*$/', $imagen);
      $urlImagen = '';
      if (!$esClaseImagen && $imagen !== '') {
          $urlImagen = preg_match('#^(https?:)?//#i', $imagen)
              ? $imagen
              : BASE_URL . ltrim($imagen, '/');
      }
  ?>
  <div class="card-pedir">
    <div class="card-image-pedir">
      <div class="imagen-cartica<?= $esClaseImagen ? ' ' . htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8') : '' ?>">
        <?php if ($urlImagen !== ''): ?>
        <img class="imagen-cartica-img" src="<?= htmlspecialchars($urlImagen, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($plato['nombre'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy">
        <?php endif; ?>
      </div>
    </div>
    <div class="card-content-pedir">
      <div class="card-text-pedir">
        <h2><?= htmlspecialchars($plato['nombre'], ENT_QUOTES, 'UTF-8') ?></h2>
        <p><?= htmlspecialchars($plato['descripcion'], ENT_QUOTES, 'UTF-8') ?></p>
      </div>
      <div class="card-price-pedir">
        <p>$<?= number_format((float) $plato['valor'], 0, ',', '.') ?></p>
        <button class="card-button-pedir" type="button" aria-label="Agregar <?= htmlspecialchars($plato['nombre'], ENT_QUOTES, 'UTF-8') ?> al carrito">+</button>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  <?php endforeach; ?>
</div>