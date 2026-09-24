<?php
require_once __DIR__ . '/../../includes/funciones.php';
auth();

require_once __DIR__ . '/../../includes/config/database.php';
$db = conectarDB();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id <= 0) {
    header("Location: index.php");
    exit;
}

$stmt = $db->prepare("SELECT imagen FROM platos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$plato = $resultado->fetch_assoc();

if ($plato) {
    $rutaImagen = $plato['imagen'];
    $stmt = $db->prepare("DELETE FROM platos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $directorioPermitido = 'assets/imagenes/platos/';
        if (str_starts_with($rutaImagen, $directorioPermitido)) {
            $archivoImagen = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $rutaImagen);

            if (is_file($archivoImagen)) {
                unlink($archivoImagen);
            }
        }
    }
}

header("Location: index.php?eliminado=1");
exit;