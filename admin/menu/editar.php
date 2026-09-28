<?php
require_once __DIR__ . '/../../includes/funciones.php';
auth();
$adminPage = true;

require_once __DIR__ . '/../../includes/config/database.php';
$db = conectarDB();

$mensaje = '';
$errores = [];
$categorias = [];

$resultadoCategorias = $db->query("SELECT id, nombre FROM categorias ORDER BY orden, id");
if ($resultadoCategorias) {
    while ($categoria = $resultadoCategorias->fetch_assoc()) {
        $categorias[] = $categoria;
    }
}

// ---------------------------
// Obtener ID del plato
// ---------------------------
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = intval($_GET['id']);

// ---------------------------
// Traer datos del plato
// ---------------------------
$stmt = $db->prepare("SELECT * FROM platos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$plato = $resultado->fetch_assoc();

if (!$plato) {
    echo "Plato no encontrado";
    exit;
}

// ---------------------------
// Valores por defecto
// ---------------------------
$nombre = $plato['nombre'];
$descripcion = $plato['descripcion'];
$categoriaId = (int) $plato['categoria_id'];
$precio = $plato['valor'];
$activo = $plato['activo'];
$orden = $plato['orden'];
$rutaImagen = $plato['imagen'];

// ---------------------------
// Procesar formulario POST
// ---------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $categoriaId = (int) ($_POST['categoria_id'] ?? 0);
    $precioIngresado = trim($_POST['precio'] ?? '');
    $precio = is_numeric($precioIngresado) ? (float) $precioIngresado : 0;
    $activo = isset($_POST['activo']) ? 1 : 0;
    $orden = intval($_POST['orden'] ?? 0);
    $imagen = $_FILES['imagen'] ?? [];

    // VALIDACIONES
    if (!$nombre) $errores['nombre'] = "El nombre es obligatorio";
    if (!$descripcion) $errores['descripcion'] = "La descripción es obligatoria";
    $categoriaValida = false;
    foreach ($categorias as $categoria) {
        if ((int) $categoria['id'] === $categoriaId) {
            $categoriaValida = true;
            break;
        }
    }
    if (!$categoriaValida) $errores['categoria'] = "Selecciona una categoría válida";
    if ($precioIngresado === '' || !is_numeric($precioIngresado) || $precio <= 0) {
        $errores['precio'] = "Precio inválido";
    }

    // Subir nueva imagen si se cargó
    $imagenNueva = false;

    if (!empty($imagen['tmp_name']) && ($imagen['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
        $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/CheoParrilla/assets/imagenes/platos/';
        if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);

        $extension = strtolower(pathinfo($imagen['name'], PATHINFO_EXTENSION));
        $permitidos = ['jpg','jpeg','png','webp','avif'];

        if (!in_array($extension, $permitidos)) {
            $errores['imagen'] = "Formato no válido";
        } elseif ($imagen['size'] > 2000000) {
            $errores['imagen'] = "Máximo 2MB";
        } else {
            $nombreImagen = md5(uniqid(rand(), true)) . "." . $extension;
            $ruta = $carpeta . $nombreImagen;

            if (move_uploaded_file($imagen['tmp_name'], $ruta)) {
                $rutaImagen = 'assets/imagenes/platos/' . $nombreImagen;
                $imagenNueva = true;
            } else {
                $errores['imagen'] = "No se pudo guardar la imagen";
            }
        }
    } elseif (($imagen['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
        $errores['imagen'] = "No se pudo cargar la imagen";
    }


    // Actualizar BD si no hay errores
    if (empty($errores)) {
        $stmt = $db->prepare("UPDATE platos SET categoria_id=?, nombre=?, descripcion=?, valor=?, activo=?, orden=?, imagen=? WHERE id=?");
        $stmt->bind_param("issdiisi", $categoriaId, $nombre, $descripcion, $precio, $activo, $orden, $rutaImagen, $id);

        if ($stmt->execute()) {
            header("Location: index.php?ok=1");
            exit;
        }

        if ($imagenNueva) @unlink($ruta);
        $errores['general'] = "No se pudo actualizar el plato";
    }
}

incluirTemplates('header');
?>

<section class="admin-container admin-container-admin">
    <main class="admin-card">
        <h1>Editar Plato</h1>

        <?php if ($mensaje): ?>
            <p class="mensajeOk"><?= $mensaje ?></p>
        <?php endif; ?>
        <?php if (isset($errores['general'])): ?>
            <p class="error"><?= $errores['general'] ?></p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="admin-form">

            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>">
            <?php if (isset($errores['nombre'])): ?>
                <p class="error"><?= $errores['nombre'] ?></p>
            <?php endif; ?>

            <label>Descripción</label>
            <textarea name="descripcion"><?= htmlspecialchars($descripcion) ?></textarea>
            <?php if (isset($errores['descripcion'])): ?>
                <p class="error"><?= $errores['descripcion'] ?></p>
            <?php endif; ?>

            <label for="categoria_id">Categoría</label>
            <select name="categoria_id" id="categoria_id" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= (int) $categoria['id'] ?>" <?= $categoriaId === (int) $categoria['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categoria['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errores['categoria'])): ?>
                <p class="error"><?= $errores['categoria'] ?></p>
            <?php endif; ?>

            <label>Precio</label>
            <input type="number" name="precio" min="0" value="<?= $precio ?>" style="color: black;">
            <?php if (isset($errores['precio'])): ?>
                <p class="error"><?= $errores['precio'] ?></p>
            <?php endif; ?>

            <label>Orden</label>
            <input type="number" name="orden" value="<?= $orden ?>" style="color: black;">

            <label>
                <input type="checkbox" name="activo" <?= $activo ? 'checked' : '' ?>> Activo
            </label>

            <label>Imagen</label>
            <input type="file" name="imagen" accept="image/*" id="inputImagen">
            <img id="previewImagen" src="<?= BASE_URL . ltrim($rutaImagen,'/') ?>?t=<?= time() ?>" width="120" style="margin-top:5px;">

            <input type="submit" value="Actualizar Plato" class="admin-btn">
        </form>
    </main>
</section>

<?php include '../../includes/templates/footer.php'; ?>


