<?php
/* ============================================================
   PANEL  -  Días bloqueados (la excepción de un día suelto).
   ============================================================ */

require_once __DIR__ . '/comun.php';
exigir_sesion();
$db = conectarDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!token_valido()) {
        guardar_mensaje('Sesión vencida. Intenta de nuevo.', 'malo');
        header('Location: bloqueos.php');
        exit;
    }

    $accion = $_POST['accion'] ?? '';

    // -------- Quitar un bloqueo --------
    if ($accion === 'quitar') {
        $id = (int)($_POST['id'] ?? 0);
        $stmt = $db->prepare("DELETE FROM reservas_bloqueos WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        guardar_mensaje('Día desbloqueado. Ya se puede reservar.');

    // -------- Agregar un bloqueo --------
    } else {
        $fecha  = trim($_POST['fecha'] ?? '');
        $motivo = trim($_POST['motivo'] ?? '');

        $d = DateTime::createFromFormat('Y-m-d', $fecha);

        if (!$d || $d->format('Y-m-d') !== $fecha) {
            guardar_mensaje('La fecha no es válida.', 'malo');

        } elseif ($d < new DateTime('today')) {
            guardar_mensaje('No tiene sentido bloquear un día que ya pasó.', 'malo');

        } elseif ($motivo === '') {
            guardar_mensaje('Escribe el motivo del bloqueo.', 'malo');

        } else {
            // Aviso útil: si ese día ya hay gente con reserva, el
            // administrador tiene que llamarlos. El sistema no cancela solo.
            $stmt = $db->prepare(
                "SELECT COUNT(*) AS n FROM reservas
                  WHERE fecha = ? AND estado IN ('pendiente','confirmada')"
            );
            $stmt->bind_param('s', $fecha);
            $stmt->execute();
            $n = (int)$stmt->get_result()->fetch_assoc()['n'];

            try {
                $stmt = $db->prepare("INSERT INTO reservas_bloqueos (fecha, motivo) VALUES (?, ?)");
                $stmt->bind_param('ss', $fecha, $motivo);
                $stmt->execute();

                $aviso = 'Día bloqueado.';
                if ($n > 0) {
                    $aviso .= " ATENCIÓN: ese día ya hay $n reserva(s) activa(s). "
                            . "Avísales por WhatsApp; el sistema no las cancela solo.";
                }
                guardar_mensaje($aviso, $n > 0 ? 'malo' : 'bien');

            } catch (Throwable $e) {
                // La llave UNIQUE de la fecha impide bloquear dos veces el mismo día.
                guardar_mensaje('Ese día ya estaba bloqueado.', 'malo');
            }
        }
    }

    header('Location: bloqueos.php');
    exit;
}

$lista = $db->query(
    "SELECT * FROM reservas_bloqueos WHERE fecha >= CURDATE() ORDER BY fecha ASC"
)->fetch_all(MYSQLI_ASSOC);

panel_cabecera('Días bloqueados', 'bloqueos.php');
mensaje_guardado();
?>

<p class="pnl-ayuda">
    Un bloqueo cierra <strong>un día concreto</strong>: un festivo, un evento privado,
    vacaciones. Para cerrar todos los lunes, mejor usa el
    <a href="horarios.php">horario semanal</a>.
</p>

<form method="POST" class="pnl-filtro">
    <input type="hidden" name="token" value="<?= token() ?>">
    <label for="fecha">Fecha</label>
    <input type="date" id="fecha" name="fecha" value="<?= date('Y-m-d') ?>">
    <label for="motivo">Motivo</label>
    <input type="text" id="motivo" name="motivo" maxlength="120"
           placeholder="Festivo, evento privado, mantenimiento...">
    <button type="submit" class="pnl-btn">Bloquear</button>
</form>

<?php if (!$lista): ?>
    <p class="pnl-vacio">No hay días bloqueados.</p>
<?php else: ?>
<table class="pnl-tabla">
    <thead><tr><th>Fecha</th><th>Día</th><th>Motivo</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($lista as $b): ?>
        <tr>
            <td><?= date('d/m/Y', strtotime($b['fecha'])) ?></td>
            <td><?= nombre_dia((int)date('N', strtotime($b['fecha']))) ?></td>
            <td><?= limpiar($b['motivo']) ?></td>
            <td>
                <form method="POST" class="pnl-linea">
                    <input type="hidden" name="token" value="<?= token() ?>">
                    <input type="hidden" name="accion" value="quitar">
                    <input type="hidden" name="id" value="<?= (int)$b['id'] ?>">
                    <button type="submit" class="pnl-btn pnl-btn-mini pnl-btn-claro">Quitar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?php panel_pie(); ?>
