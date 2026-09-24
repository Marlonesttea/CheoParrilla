<?php
/* ============================================================
   PASO 1  -  El cliente escoge personas, fecha y hora.
   Los datos personales se piden en el paso 2, cuando ya escogio.
   ============================================================ */

require_once __DIR__ . '/../includes/agenda_reservas.php';
$db = conectarDB();

$hoy       = date('Y-m-d');
$minPer    = (int)cfg($db, 'min_personas', 1);
$maxPer    = (int)cfg($db, 'max_personas', 10);
$diasTope  = (int)cfg($db, 'dias_anticipacion', 30);
$whatsapp  = cfg($db, 'whatsapp');

// Mes que se esta mostrando en el calendario (se mueve con las flechas)
$mes  = isset($_GET['mes'])  ? (int)$_GET['mes']  : (int)date('n');
$anio = isset($_GET['anio']) ? (int)$_GET['anio'] : (int)date('Y');
if ($mes < 1 || $mes > 12) { $mes = (int)date('n'); }

// ---- Armado del calendario del mes ----
$primero    = mktime(0, 0, 0, $mes, 1, $anio);
$diasMes    = (int)date('t', $primero);
$diaSemana1 = (int)date('N', $primero);          // 1 lunes ... 7 domingo
$topeFecha  = date('Y-m-d', strtotime("+$diasTope days"));

// Mes anterior / siguiente
$mesAnt  = $mes - 1; $anioAnt  = $anio;
if ($mesAnt < 1)  { $mesAnt = 12; $anioAnt--; }
$mesSig  = $mes + 1; $anioSig  = $anio;
if ($mesSig > 12) { $mesSig = 1;  $anioSig++; }

$titulo = 'Reservar mesa';
$raiz   = '..';
require __DIR__ . '/../includes/templates/header_reservas.php';
?>

<section class="rsv-pasos">
    <span class="rsv-paso rsv-paso-activo">1. Selecciona los datos</span>
    <span class="rsv-linea"></span>
    <span class="rsv-paso">2. Confirma tu reserva</span>
</section>

<p class="rsv-resumen" id="resumen">
    <span id="rPersonas">2 personas</span> /
    <span id="rFecha">—</span> /
    <span id="rHora">—</span>
</p>

<!-- El formulario solo envia tres datos: personas, fecha y hora. -->
<form method="GET" action="confirmar.php" id="formReserva">

<div class="rsv-tarjetas">

    <!-- ============ TARJETA 1: PERSONAS ============ -->
    <article class="rsv-tarjeta">
        <h2>Personas</h2>
        <p class="rsv-sub">Selecciona el número de personas</p>

        <div class="rsv-personas" id="personas">
            <?php for ($i = $minPer; $i <= $maxPer; $i++): ?>
                <button type="button"
                        class="rsv-bola <?= $i === 2 ? 'rsv-activo' : '' ?>"
                        data-personas="<?= $i ?>"><?= $i ?></button>
            <?php endfor; ?>
        </div>

        <p class="rsv-nota">
            ¿Necesitas un evento?<br>
            <a href="https://wa.me/<?= limpiar($whatsapp) ?>" target="_blank" rel="noopener">
                Comunícate con nosotros
            </a>
        </p>

        <input type="hidden" name="personas" id="inPersonas" value="2">
    </article>

    <!-- ============ TARJETA 2: FECHA ============ -->
    <article class="rsv-tarjeta">
        <h2>Fecha</h2>
        <p class="rsv-sub">Selecciona la fecha para tu reserva</p>

        <div class="rsv-mes">
            <a class="rsv-flecha" href="?mes=<?= $mesAnt ?>&anio=<?= $anioAnt ?>">&lsaquo;</a>
            <strong><?= nombre_mes($mes) ?> <?= $anio ?></strong>
            <a class="rsv-flecha" href="?mes=<?= $mesSig ?>&anio=<?= $anioSig ?>">&rsaquo;</a>
        </div>

        <table class="rsv-calendario">
            <thead>
                <tr>
                    <th>LUN</th><th>MAR</th><th>MIÉ</th><th>JUE</th>
                    <th>VIE</th><th>SÁB</th><th>DOM</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                // Casillas vacias antes del dia 1
                for ($v = 1; $v < $diaSemana1; $v++) {
                    echo '<td></td>';
                }
                $columna = $diaSemana1;

                for ($d = 1; $d <= $diasMes; $d++) {

                    $fecha = sprintf('%04d-%02d-%02d', $anio, $mes, $d);

                    // La MISMA funcion que valida al guardar decide si el
                    // dia se puede pintar o no. La regla esta escrita una vez.
                    $problema = fecha_reservable($db, $fecha);
                    $clase    = $problema === '' ? 'rsv-dia' : 'rsv-dia rsv-dia-no';

                    echo '<td>';
                    if ($problema === '') {
                        echo '<button type="button" class="' . $clase . '" data-fecha="' . $fecha . '">' . $d . '</button>';
                    } else {
                        echo '<span class="' . $clase . '" title="' . limpiar($problema) . '">' . $d . '</span>';
                    }
                    echo '</td>';

                    $columna++;
                    if ($columna > 7 && $d < $diasMes) {
                        echo '</tr><tr>';
                        $columna = 1;
                    }
                }
                // Casillas vacias al final
                while ($columna <= 7) { echo '<td></td>'; $columna++; }
                ?>
            </tr>
            </tbody>
        </table>

        <input type="hidden" name="fecha" id="inFecha" value="">
    </article>

    <!-- ============ TARJETA 3: HORA ============ -->
    <article class="rsv-tarjeta">
        <h2>Hora</h2>
        <p class="rsv-sub">Selecciona una hora disponible</p>

        <div class="rsv-dia-elegido" id="diaElegido">Escoge primero una fecha</div>

        <!-- Estas horas las trae api_horas.php segun el dia y las personas -->
        <div class="rsv-horas" id="horas"></div>

        <p class="rsv-leyenda">
            <span class="rsv-punto rsv-punto-libre"></span> Horas disponibles
            <span class="rsv-punto rsv-punto-no"></span> Horas no disponibles
        </p>

        <input type="hidden" name="hora" id="inHora" value="">
    </article>

</div>

<button type="submit" class="rsv-continuar" id="btnContinuar" disabled>CONTINUAR</button>
<p class="rsv-error" id="errorGeneral"></p>

</form>

<?php require __DIR__ . '/../includes/templates/footer_reservas.php'; ?>
<script src="js/reservas.js"></script>
