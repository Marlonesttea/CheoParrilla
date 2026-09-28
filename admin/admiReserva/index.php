<?php
/* ============================================================
   PANEL  -  Listado de reservas del día y cambio de estado.
   ============================================================ */

require_once __DIR__ . '/comun.php';
exigir_sesion();
$db = conectarDB();

$estadosValidos = ['pendiente', 'confirmada', 'cumplida', 'cancelada', 'no_asistio'];

/* ---------------- Cambio de estado ---------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!token_valido()) {
        guardar_mensaje('Sesión vencida. Intenta de nuevo.', 'malo');
    } else {
        $id     = (int)($_POST['id'] ?? 0);
        $estado = $_POST['estado'] ?? '';

        // El estado que llega del navegador SIEMPRE se revisa contra la
        // lista permitida. Nunca se mete directo en la consulta.
        if ($id > 0 && in_array($estado, $estadosValidos, true)) {
            $stmt = $db->prepare("UPDATE reservas SET estado = ? WHERE id = ?");
            $stmt->bind_param('si', $estado, $id);
            $stmt->execute();
            guardar_mensaje('Reserva actualizada.');
        } else {
            guardar_mensaje('Estado no válido.', 'malo');
        }
    }

    header('Location: index.php?fecha=' . urlencode($_POST['fecha_vista'] ?? date('Y-m-d')));
    exit;
}

/* ---------------- Filtro por fecha ---------------- */
$fecha = $_GET['fecha'] ?? date('Y-m-d');
$d = DateTime::createFromFormat('Y-m-d', $fecha);
if (!$d || $d->format('Y-m-d') !== $fecha) {
    $fecha = date('Y-m-d');
}

$stmt = $db->prepare(
    "SELECT * FROM reservas WHERE fecha = ? ORDER BY hora ASC, id ASC"
);
$stmt->bind_param('s', $fecha);
$stmt->execute();
$lista = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

/* ---------------- Contadores del día ----------------
   Solo suman las personas de las reservas que ocupan mesa. */
$stmt = $db->prepare(
    "SELECT
        COUNT(*) AS total,
        SUM(estado = 'pendiente')  AS pendientes,
        SUM(estado = 'confirmada') AS confirmadas,
        SUM(CASE WHEN estado IN ('pendiente','confirmada','cumplida')
                 THEN personas ELSE 0 END) AS comensales
     FROM reservas WHERE fecha = ?"
);
$stmt->bind_param('s', $fecha);
$stmt->execute();
$res = $stmt->get_result()->fetch_assoc();

$capacidad = (int)cfg($db, 'capacidad_local', 40);

panel_cabecera('Reservas', 'index.php');
mensaje_guardado();
?>

<form method="GET" class="pnl-filtro">
    <label for="fecha">Ver el día</label>
    <input type="date" id="fecha" name="fecha" value="<?= limpiar($fecha) ?>">
    <button type="submit" class="pnl-btn">Ver</button>
    <a class="pnl-btn pnl-btn-claro" href="index.php?fecha=<?= date('Y-m-d') ?>">Hoy</a>
</form>

<div class="pnl-tarjetas">
    <div class="pnl-dato"><span>Reservas</span><strong><?= (int)$res['total'] ?></strong></div>
    <div class="pnl-dato"><span>Pendientes</span><strong><?= (int)$res['pendientes'] ?></strong></div>
    <div class="pnl-dato"><span>Confirmadas</span><strong><?= (int)$res['confirmadas'] ?></strong></div>
    <div class="pnl-dato">
        <span>Personas esperadas</span>
        <strong><?= (int)$res['comensales'] ?> <small>/ <?= $capacidad ?></small></strong>
    </div>
</div>

<?php if (!$lista): ?>
    <p class="pnl-vacio">No hay reservas para ese día.</p>
<?php else: ?>

<table class="pnl-tabla">
    <thead>
        <tr>
            <th>Hora</th><th>Código</th><th>Cliente</th><th>Celular</th>
            <th>Pers.</th><th>Nota</th><th>Estado</th><th>Cambiar a</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($lista as $r): ?>
        <tr class="pnl-e-<?= limpiar($r['estado']) ?>">
            <td><strong><?= limpiar(hora_bonita($r['hora'])) ?></strong></td>
            <td><?= limpiar($r['codigo']) ?></td>
            <td><?= limpiar($r['nombre']) ?></td>
            <td>
                <a href="https://wa.me/57<?= limpiar($r['telefono']) ?>" target="_blank" rel="noopener">
                    <?= limpiar($r['telefono']) ?>
                </a>
            </td>
            <td><?= (int)$r['personas'] ?></td>
            <td class="pnl-nota"><?= limpiar($r['notas'] ?? '') ?></td>
            <td><span class="pnl-etiqueta"><?= limpiar(str_replace('_', ' ', $r['estado'])) ?></span></td>
            <td>
                <form method="POST" class="pnl-linea">
                    <input type="hidden" name="token" value="<?= token() ?>">
                    <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                    <input type="hidden" name="fecha_vista" value="<?= limpiar($fecha) ?>">
                    <select name="estado">
                        <?php foreach ($estadosValidos as $e): ?>
                            <option value="<?= $e ?>" <?= $e === $r['estado'] ? 'selected' : '' ?>>
                                <?= str_replace('_', ' ', $e) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="pnl-btn pnl-btn-mini">Guardar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p class="pnl-ayuda">
    <strong>Recuerda:</strong> pendiente, confirmada y cumplida <u>ocupan</u> la mesa.
    Cancelada y no asistió <u>liberan</u> la hora para que otro cliente pueda reservarla.
    Una reserva nunca se borra.
</p>

<?php endif; ?>

<?php panel_pie(); ?>
