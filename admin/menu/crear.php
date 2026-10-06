<?php
require_once __DIR__ . '/../../includes/funciones.php';
auth();
$adminPage = true;
$scripts = ['app', 'editar'];

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

$nombre = '';
$descripcion = '';
$categoriaId = 0;
$precio = '';
$activo = 1;
$orden = 0;
$rutaImagen = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $categoriaId = (int) ($_POST['categoria_id'] ?? 0);
    $precioIngresado = trim($_POST['precio'] ?? '');
    $precio = is_numeric($precioIngresado) ? (float) $precioIngresado : 0;
    $activo = isset($_POST['activo']) ? 1 : 0;
    $orden = (int) ($_POST['orden'] ?? 0);
    $imagen = $_FILES['imagen'] ?? [];

    if ($nombre === '') $errores['nombre'] = 'El nombre es obligatorio';
    if ($descripcion === '') $errores['descripcion'] = 'La descripción es obligatoria';

    $categoriaValida = false;
    foreach ($categorias as $categoria) {
        if ((int) $categoria['id'] === $categoriaId) {
            $categoriaValida = true;
            break;
        }
    }
    if (!$categoriaValida) $errores['categoria'] = 'Selecciona una categoría válida';
    if ($precioIngresado === '' || !is_numeric($precioIngresado) || $precio <= 0) {
        $errores['precio'] = 'Precio inválido';
    }

    $imagenNueva = false;
    $errorImagen = $imagen['error'] ?? UPLOAD_ERR_NO_FILE;
    if (empty($errores) && $errorImagen !== UPLOAD_ERR_NO_FILE) {
        if ($errorImagen !== UPLOAD_ERR_OK) {
            $errores['imagen'] = 'No se pudo cargar la imagen';
        } else {
            $extension = strtolower(pathinfo($imagen['name'] ?? '', PATHINFO_EXTENSION));
            $permitidos = ['jpg', 'jpeg', 'png', 'webp', 'avif'];

            if (!in_array($extension, $permitidos, true)) {
                $errores['imagen'] = 'Formato no válido';
            } elseif (($imagen['size'] ?? 0) > 2000000) {
                $errores['imagen'] = 'Máximo 2MB';
            } else {
                $carpeta = __DIR__ . '/../../assets/imagenes/platos/';
                if (!is_dir($carpeta) && !mkdir($carpeta, 0755, true) && !is_dir($carpeta)) {
                    $errores['imagen'] = 'No se pudo guardar la imagen';
                } else {
                    $nombreImagen = bin2hex(random_bytes(16)) . '.' . $extension;
                    $ruta = $carpeta . $nombreImagen;

                    if (move_uploaded_file($imagen['tmp_name'], $ruta)) {
                        $rutaImagen = 'assets/imagenes/platos/' . $nombreImagen;
                        $imagenNueva = true;
                    } else {
                        $errores['imagen'] = 'No se pudo guardar la imagen';
                    }
                }
            }
        }
    }

    if (empty($errores)) {
        $stmt = $db->prepare("INSERT INTO platos (categoria_id, nombre, descripcion, valor, activo, orden, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param('issdiis', $categoriaId, $nombre, $descripcion, $precio, $activo, $orden, $rutaImagen);
            if ($stmt->execute()) {
                header('Location: index.php?ok=1');
                exit;
            }
        }

        if ($imagenNueva && isset($ruta)) @unlink($ruta);
        $errores['general'] = 'No se pudo crear el plato';
    }
}

incluirTemplates('header');
?>

<section class="admin-container admin-container-admin">
    <main class="admin-card">
        <h1>Crear Plato</h1>

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
            <p class="imagen-ayuda">Imagen opcional. Formatos: jpg, jpeg, png, webp, avif. Máximo 2MB.</p>
            <?php if (isset($errores['imagen'])): ?>
                <p class="error"><?= $errores['imagen'] ?></p>
            <?php endif; ?>
            <img id="previewImagen" <?php if ($rutaImagen !== ''): ?>src="<?= BASE_URL . ltrim($rutaImagen, '/') ?>?t=<?= time() ?>"<?php else: ?>hidden<?php endif; ?> width="120" style="margin-top:5px;">

            <div class="admin-form-acciones">
                <input type="submit" value="Guardar Plato" class="admin-btn">
                <a href="index.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>

        <a href="index.php" class="menu-btn-volver">⬅ Volver al listado</a>
        <a href="<?php echo BASE_URL; ?>admin/index.php" class="menu-btn-volver">⬅ Volver al panel</a>
    </main>
</section>

<?php include '../../includes/templates/footer.php'; ?>