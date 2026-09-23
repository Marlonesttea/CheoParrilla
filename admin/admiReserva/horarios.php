<?php
/* ============================================================
   PANEL  -  Horario de los 7 días de la semana.
   ------------------------------------------------------------
   OJO con el error que se comete aquí muy seguido: guardar cada
   día dentro del mismo ciclo que lo valida. Si el jueves está
   mal escrito, lunes a miércoles YA quedaron guardados y el
   formulario queda a medias.

   Por eso aquí hay DOS pasos separados:
   1) revisar los siete días
   2) solo si no hay ni un error, guardarlos todos
   Es la misma idea de una transacción.
   ============================================================ */

require_once __DIR__ . '/comun.php';
exigir_sesion();
$db = conectarDB();

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!token_valido()) {
        $errores[] = 'Sesión vencida. Intenta de nuevo.';
    } else {

        $paraGuardar = [];

        // ---------- PASO 1: revisar los siete ----------
        for ($dia = 1; $dia <= 7; $dia++) {

            $abre     = isset($_POST['abre'][$dia]) ? 1 : 0;
            $apertura = $_POST['apertura'][$dia] ?? '';
            $cierre   = $_POST['cierre'][$dia]   ?? '';

            if (!preg_match('/^\d{2}:\d{2}$/', $apertura) ||
                !preg_match('/^\d{2}:\d{2}$/', $cierre)) {
                $errores[] = nombre_dia($dia) . ': las horas no son válidas.';
                continue;
            }

            if (a_minutos($cierre) <= a_minutos($apertura)) {
                $errores[] = nombre_dia($dia) . ': la hora de cierre debe ser mayor que la de apertura.';
                continue;
            }

            $duracion = (int)cfg($db, 'duracion_min', 90);
            if (a_minutos($cierre) - a_minutos($apertura) < $duracion) {
                $errores[] = nombre_dia($dia) . ": el día abre menos de $duracion minutos, no cabe ni una reserva.";
                continue;
            }

            $paraGuardar[$dia] = [$abre, $apertura . ':00', $cierre . ':00'];
        }

        // ---------- PASO 2: guardar, solo si TODO está bien ----------
        if (empty($errores)) {
            $stmt = $db->prepare(
                "UPDATE reservas_horarios SET abre = ?, apertura = ?, cierre = ? WHERE dia_semana = ?"
            );
            foreach ($paraGuardar as $dia => $v) {
                $stmt->bind_param('issi', $v[0], $v[1], $v[2], $dia);
                $stmt->execute();
            }
            guardar_mensaje('Horario semanal actualizado.');
            header('Location: horarios.php');
            exit;
        }
    }
}

$horarios = [];
$res = $db->query("SELECT * FROM reservas_horarios ORDER BY dia_semana");
while ($f = $res->fetch_assoc()) {
    $horarios[(int)$f['dia_semana']] = $f;
}

panel_cabecera('Horario semanal', 'horarios.php');
mensaje_guardado();

foreach ($errores as $e) {
    echo '<p class="pnl-msg pnl-malo">' . limpiar($e) . '</p>';
}
?>

<p class="pnl-ayuda">
    Esta es la <strong>regla que se repite cada semana</strong>. Para cerrar un día suelto
    (un festivo, un evento privado) usa <a href="bloqueos.php">Días bloqueados</a>.
</p>

<form method="POST">
    <input type="hidden" name="token" value="<?= token() ?>">

    <table class="pnl-tabla">
        <thead>
            <tr><th>Día</th><th>¿Abre?</th><th>Apertura</th><th>Cierre</th></tr>
        </thead>
        <tbody>
        <?php for ($dia = 1; $dia <= 7; $dia++):
            $h = $horarios[$dia]; ?>
            <tr>
                <td><strong><?= nombre_dia($dia) ?></strong></td>
                <td>
                    <input type="checkbox" name="abre[<?= $dia ?>]" value="1"
                           <?= (int)$h['abre'] === 1 ? 'checked' : '' ?>>
                </td>
                <td>
                    <input type="time" name="apertura[<?= $dia ?>]"
                           value="<?= substr($h['apertura'], 0, 5) ?>">
                </td>
                <td>
                    <input type="time" name="cierre[<?= $dia ?>]"
                           value="<?= substr($h['cierre'], 0, 5) ?>">
                </td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>

    <button type="submit" class="pnl-btn">Guardar el horario</button>
</form>

<?php panel_pie(); ?>
