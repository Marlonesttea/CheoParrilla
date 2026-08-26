<?php
require_once __DIR__ . '/../includes/funciones.php';
auth();

require_once __DIR__ . '/../includes/config/database.php';
$db = conectarDB();

incluirTemplates('header');
    // 🔐 VALIDAR ID
    if (!isset($_POST['id'])) {
        header("Location: index.php");
        exit;
    }

    $id = intval($_POST['id']);

    if ($id <= 0) {
        header("Location: index.php");
        exit;
    }

    // obtener imagen para eliminar archivo físico
    $stmt = $db->prepare("SELECT imagen FROM platos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $plato = $resultado->fetch_assoc();

    if ($plato) {

        // ELIMINAR IMAGEN DEL SERVIDOR 
        if (!empty($plato['imagen'])) {
            $rutaImagen = $_SERVER['DOCUMENT_ROOT'] . '/CheoParrilla/' . $plato['imagen'];

            if (file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }
        }

        // ELIMINAR DE LA BASE DE DATOS
        $stmt = $db->prepare("DELETE FROM platos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    // REDIRECCIÓN
    header("Location: index.php?eliminado=1");
    exit;