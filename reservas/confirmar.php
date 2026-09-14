<?php
/* ============================================================
   PASO 2  -  Datos del cliente y guardado.
   ------------------------------------------------------------
   Este archivo hace dos cosas:
   - Si llega por GET: muestra el formulario con el resumen.
   - Si llega por POST: valida, VUELVE A VERIFICAR EL CUPO,
     y guarda dentro de una transaccion.
   ============================================================ */

require_once __DIR__ . '/config/agenda.php';
session_start();
$db = bd();

$errores = [];

/* ------------------------------------------------------------
   Los tres datos del paso 1 llegan por la URL (GET) o por el
   formulario (POST). Se leen igual en los dos casos.
   ------------------------------------------------------------ */
$personas = (int)($_POST['personas'] ?? $_GET['personas'] ?? 0);
$fecha    = trim($_POST['fecha'] ?? $_GET['fecha'] ?? '');
$hora     = trim($_POST['hora']  ?? $_GET['hora']  ?? '');

$nombre   = trim($_POST['nombre']   ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$notas    = trim($_POST['notas']    ?? '');

$minPer = (int)cfg($db, 'min_personas', 1);
$maxPer = (int)cfg($db, 'max_personas', 10);

/* ------------------------------------------------------------
   Revision de la seleccion del paso 1. Si algo no cuadra, se
   devuelve al cliente al paso 1. Ojo: esto se revisa SIEMPRE,
   aunque la pagina anterior ya lo hubiera revisado, porque
   cualquiera puede escribir la URL a mano.
   ------------------------------------------------------------ */
$problema = fecha_reservable($db, $fecha);

if ($personas < $minPer || $personas > $maxPer) {
    $problema = "El número de personas debe estar entre $minPer y $maxPer.";
}
if ($problema === '' && !preg_match('/^\d{2}:\d{2}$/', $hora)) {
    $problema = 'La hora seleccionada no es válida.';
}

if ($problema !== '') {
    $titulo = 'Reservar mesa'; $raiz = '..';
    require __DIR__ . '/includes/cabecera.php';
    echo '<div class="rsv-aviso rsv-aviso-malo"><p>' . limpiar($problema) . '</p>'
       . '<a class="rsv-btn" href="index.php">Volver a empezar</a></div>';
    require __DIR__ . '/includes/pie.php';
    exit;
}

/* ============================================================
   GUARDADO
   ============================================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ---- Validaciones de los datos del cliente ----
    if ($nombre === '') {
        $errores['nombre'] = 'Escribe tu nombre.';
    } elseif (largo($nombre) < 3 || largo($nombre) > 80) {
        $errores['nombre'] = 'El nombre debe tener entre 3 y 80 letras.';
    }

    // Se le quitan espacios y guiones antes de revisarlo.
    $telLimpio = preg_replace('/[\s\-\(\)]/', '', $telefono);
    if ($telLimpio === '') {
        $errores['telefono'] = 'Escribe tu número de celular.';
    } elseif (!preg_match('/^3\d{9}$/', $telLimpio)) {
        $errores['telefono'] = 'El celular debe tener 10 dígitos y empezar por 3.';
    }

    if (largo($notas) > 200) {
        $errores['notas'] = 'La nota es demasiado larga (máximo 200 letras).';
    }

    /* --------------------------------------------------------
       LA VERIFICACION QUE IMPORTA
       --------------------------------------------------------
       Se pregunta otra vez si hay cupo, aunque la pantalla
       anterior ya mostraba esa hora como libre. Entre que el
       cliente escogio y confirmo pudieron pasar dos minutos,
       y en ese rato otra persona pudo tomar el ultimo puesto.
       -------------------------------------------------------- */
    if (empty($errores) && !hay_cupo($db, $fecha, $hora, $personas)) {
        $errores['cupo'] = 'Lo sentimos: alguien acaba de tomar esa hora. '
                         . 'Escoge otra, por favor.';
    }

    // ---- Si todo esta bien, se guarda ----
    if (empty($errores)) {

        $db->begin_transaction();

        try {
            $stmt = $db->prepare(
                "INSERT INTO reservas (codigo, nombre, telefono, personas, fecha, hora, notas, estado)
                 VALUES ('', ?, ?, ?, ?, ?, ?, 'pendiente')"
            );
            $notasGuardar = ($notas === '') ? null : $notas;
            $stmt->bind_param('ssisss', $nombre, $telLimpio, $personas, $fecha, $hora, $notasGuardar);
            $stmt->execute();

            // El codigo se arma con el id que MySQL acaba de asignar.
            $id     = $db->insert_id;
            $codigo = codigo_reserva($id);

            $up = $db->prepare("UPDATE reservas SET codigo = ? WHERE id = ?");
            $up->bind_param('si', $codigo, $id);
            $up->execute();

            $db->commit();

            // PRG: se redirige para que al recargar no se duplique la reserva.
            header('Location: listo.php?codigo=' . urlencode($codigo));
            exit;

        } catch (Throwable $e) {
            // Si algo falla a mitad de camino, no queda una reserva a medias.
            $db->rollback();
            $errores['cupo'] = 'No se pudo guardar la reserva. Intenta de nuevo.';
        }
    }
}

$titulo = 'Confirma tu reserva';
$raiz   = '..';
require __DIR__ . '/includes/cabecera.php';
?>

<section class="rsv-pasos">
    <span class="rsv-paso">1. Selecciona los datos</span>
    <span class="rsv-linea"></span>
    <span class="rsv-paso rsv-paso-activo">2. Confirma tu reserva</span>
</section>

<div class="rsv-confirmar">

    <div class="rsv-resumen-caja">
        <h2>Tu reserva</h2>
        <ul>
            <li><span>Personas</span><strong><?= $personas ?></strong></li>
            <li><span>Fecha</span><strong>
                <?= nombre_dia((int)date('N', strtotime($fecha))) ?>
                <?= date('j', strtotime($fecha)) ?> de
                <?= strtolower(nombre_mes((int)date('n', strtotime($fecha)))) ?>
            </strong></li>
            <li><span>Hora</span><strong><?= limpiar(hora_bonita($hora)) ?></strong></li>
        </ul>
        <a href="index.php" class="rsv-cambiar">Cambiar la selección</a>
    </div>

    <form method="POST" class="rsv-form" novalidate>

        <!-- La seleccion del paso 1 viaja escondida hasta aqui -->
        <input type="hidden" name="personas" value="<?= $personas ?>">
        <input type="hidden" name="fecha"    value="<?= limpiar($fecha) ?>">
        <input type="hidden" name="hora"     value="<?= limpiar($hora) ?>">

        <?php if (isset($errores['cupo'])): ?>
            <p class="rsv-error-caja"><?= limpiar($errores['cupo']) ?></p>
        <?php endif; ?>

        <label for="nombre">Nombre y apellido <span>*</span></label>
        <input type="text" id="nombre" name="nombre" maxlength="80"
               value="<?= limpiar($nombre) ?>" placeholder="Tu nombre">
        <?php if (isset($errores['nombre'])): ?>
            <p class="rsv-error"><?= limpiar($errores['nombre']) ?></p>
        <?php endif; ?>

        <label for="telefono">Celular <span>*</span></label>
        <input type="tel" id="telefono" name="telefono" maxlength="20"
               value="<?= limpiar($telefono) ?>" placeholder="3001234567">
        <?php if (isset($errores['telefono'])): ?>
            <p class="rsv-error"><?= limpiar($errores['telefono']) ?></p>
        <?php endif; ?>

        <label for="notas">¿Algo que debamos saber?</label>
        <textarea id="notas" name="notas" rows="3" maxlength="200"
                  placeholder="Cumpleaños, silla para bebé, mesa cerca a la ventana..."><?= limpiar($notas) ?></textarea>
        <?php if (isset($errores['notas'])): ?>
            <p class="rsv-error"><?= limpiar($errores['notas']) ?></p>
        <?php endif; ?>

        <button type="submit" class="rsv-continuar">CONFIRMAR RESERVA</button>
        <p class="rsv-nota">
            La reserva queda <strong>pendiente</strong>. El restaurante te la confirma
            por WhatsApp.
        </p>
    </form>

</div>

<?php require __DIR__ . '/includes/pie.php'; ?>
<script src="js/confirmar.js"></script>
