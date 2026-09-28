<?php
/* ============================================================
   LISTO.PHP  -  Comprobante de la reserva.
   Muestra el codigo y arma el mensaje de WhatsApp ya escrito,
   igual que se hace con los pedidos del restaurante.
   ============================================================ */

require_once __DIR__ . '/../includes/agenda_reservas.php';
$db = conectarDB();

$codigo = trim($_GET['codigo'] ?? '');

$stmt = $db->prepare("SELECT * FROM reservas WHERE codigo = ?");
$stmt->bind_param('s', $codigo);
$stmt->execute();
$reserva = $stmt->get_result()->fetch_assoc();

$titulo = 'Reserva registrada';
$raiz   = '..';
require __DIR__ . '/../includes/templates/header_reservas.php';

if (!$reserva):
    echo '<div class="rsv-aviso rsv-aviso-malo"><p>No encontramos esa reserva.</p>'
       . '<a class="rsv-btn" href="index.php">Hacer una reserva</a></div>';
else:

    $whatsapp = cfg($db, 'whatsapp');
    $negocio  = cfg($db, 'nombre_negocio');

    // El mensaje se arma en el servidor y se codifica para la URL.
    $mensaje = "Hola $negocio, acabo de reservar una mesa.\n"
             . "Código: {$reserva['codigo']}\n"
             . "Nombre: {$reserva['nombre']}\n"
             . "Personas: {$reserva['personas']}\n"
             . "Fecha: " . date('d/m/Y', strtotime($reserva['fecha'])) . "\n"
             . "Hora: " . hora_bonita($reserva['hora']) . "\n";
    if (!empty($reserva['notas'])) {
        $mensaje .= "Nota: {$reserva['notas']}\n";
    }
    $mensaje .= "Quedo atento a la confirmación.";

    $enlace = 'https://wa.me/' . rawurlencode($whatsapp) . '?text=' . rawurlencode($mensaje);
?>

<div class="rsv-aviso rsv-aviso-bien">

    <h1>¡Reserva registrada!</h1>

    <p class="rsv-codigo"><?= limpiar($reserva['codigo']) ?></p>
    <p>Guarda este código. Con él puedes consultar o cambiar tu reserva.</p>

    <ul class="rsv-detalle">
        <li><span>Nombre</span><strong><?= limpiar($reserva['nombre']) ?></strong></li>
        <li><span>Personas</span><strong><?= (int)$reserva['personas'] ?></strong></li>
        <li><span>Fecha</span><strong><?= date('d/m/Y', strtotime($reserva['fecha'])) ?></strong></li>
        <li><span>Hora</span><strong><?= limpiar(hora_bonita($reserva['hora'])) ?></strong></li>
        <li><span>Estado</span><strong>Pendiente de confirmación</strong></li>
    </ul>

    <a class="rsv-btn rsv-btn-wa" href="<?= limpiar($enlace) ?>" target="_blank" rel="noopener">
        Avisar por WhatsApp
    </a>

    <p class="rsv-nota">
        Tu mesa está apartada. El restaurante te escribe por WhatsApp para confirmarla.
    </p>

    <a href="<?= $raiz ?>/index.php" class="rsv-cambiar">Volver al inicio</a>
</div>

<?php endif; ?>
<?php require __DIR__ . '/../includes/templates/footer_reservas.php'; ?>
