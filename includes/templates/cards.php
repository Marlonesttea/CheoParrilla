<?php
require_once __DIR__ . '/../config/database.php';

$db = conectarDB();
$consulta = $db->query(
    "SELECT c.id AS categoria_id, c.nombre AS categoria, c.slug,
            p.id, p.nombre, p.descripcion, p.valor, p.imagen
     FROM categorias c
     LEFT JOIN platos p ON p.categoria_id = c.id AND p.activo = 1
     ORDER BY c.orden, c.id, p.orden, p.id"
);

$categorias = [];
if ($consulta) {
    while ($fila = $consulta->fetch_assoc()) {
        $categoriaId = (int) $fila['categoria_id'];
        if (!isset($categorias[$categoriaId])) {
            $categorias[$categoriaId] = [
                'nombre' => $fila['categoria'],
                'slug' => $fila['slug'],
                'platos' => [],
            ];
        }

        if ($fila['id'] !== null) {
            $categorias[$categoriaId]['platos'][] = $fila;
        }
    }
}

foreach ($categorias as $categoria):
    $slug = preg_replace('/[^a-z0-9-]/', '', strtolower($categoria['slug']));
?>
<section class="barra container" id="<?= htmlspecialchars($slug) ?>" style="margin: 50px;">
    <h2><?= htmlspecialchars($categoria['nombre']) ?></h2>
</section>

<?php foreach ($categoria['platos'] as $plato):
    $imagen = trim((string) $plato['imagen']);
    $esClaseImagen = (bool) preg_match('/^imagenCards\d*$/', $imagen);
    $estiloImagen = '';
    if (!$esClaseImagen && $imagen !== '') {
        $estiloImagen = ' style="background-image: url(' . htmlspecialchars($imagen, ENT_QUOTES, 'UTF-8') . '); background-size: cover; background-position: center"';
    }
    $claseImagen = $esClaseImagen ? $imagen : '';
?>
<div class="uiv-card" data-description="<?= htmlspecialchars($plato['descripcion'], ENT_QUOTES, 'UTF-8') ?>">
    <div id="uiv-cardnewfilter"><p>NEW</p></div>
    <div id="uiv-cardbrightfilter"></div>
    <div id="uiv-cardtop" class="<?= htmlspecialchars($claseImagen) ?>"<?= $estiloImagen ?>>
        <p></p>
    </div>
    <div id="uiv-cardbottom">
        <p id="uiv-cardbottomtitle"><?= htmlspecialchars($plato['nombre']) ?></p>
        <p id="uiv-cardbottomprice">$<?= number_format((float) $plato['valor'], 0, ',', '.') ?></p>
    </div>
</div>
<?php endforeach; ?>
<?php endforeach; ?>
