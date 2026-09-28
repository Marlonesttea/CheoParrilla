<?php
/* ============================================================
   API_HORAS.PHP
   ------------------------------------------------------------
   Este archivo no muestra una pagina: devuelve datos en JSON.
   El JavaScript lo llama cada vez que el cliente cambia la
   fecha o el numero de personas, y con la respuesta pinta los
   botones de hora habilitados o en gris.

   Es la pieza que hace que la disponibilidad se vea "en vivo".
   ============================================================ */

require_once __DIR__ . '/../includes/agenda_reservas.php';

header('Content-Type: application/json; charset=utf-8');

$db = conectarDB();

$fecha    = $_GET['fecha']    ?? '';
$personas = (int)($_GET['personas'] ?? 0);

// --- Validaciones: el servidor nunca se fia de lo que llega ---
$minPer = (int)cfg($db, 'min_personas', 1);
$maxPer = (int)cfg($db, 'max_personas', 10);

if ($personas < $minPer || $personas > $maxPer) {
    echo json_encode([
        'ok'      => false,
        'mensaje' => "El número de personas debe estar entre $minPer y $maxPer.",
        'horas'   => [],
    ]);
    exit;
}

$problema = fecha_reservable($db, $fecha);
if ($problema !== '') {
    echo json_encode(['ok' => false, 'mensaje' => $problema, 'horas' => []]);
    exit;
}

// --- Todo bien: se calculan las franjas ---
$horas = horas_del_dia($db, $fecha, $personas);

$dia = (int)date('N', strtotime($fecha));

echo json_encode([
    'ok'        => true,
    'mensaje'   => '',
    'etiqueta'  => nombre_dia($dia) . ' ' . date('j', strtotime($fecha)) . ' de ' . strtolower(nombre_mes((int)date('n', strtotime($fecha)))),
    'horas'     => $horas,
], JSON_UNESCAPED_UNICODE);
