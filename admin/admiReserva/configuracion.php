<?php
/* ============================================================
   PANEL  -  Configuración del módulo.
   ------------------------------------------------------------
   Esta pantalla es la mejor demostración de la sustentación:
   al cambiar la capacidad del local o el intervalo, la página
   pública ofrece otras horas, SIN tocar una línea de código.
   ============================================================ */

require_once __DIR__ . '/comun.php';
exigir_sesion();
$db = conectarDB();

$errores = [];

// Reglas de cada campo: [minimo, maximo] para los numericos.
$numericos = [
    'capacidad_local'   => [1, 500],
    'intervalo_min'     => [15, 120],
    'duracion_min'      => [30, 300],
    'dias_anticipacion' => [1, 365],
    'min_personas'      => [1, 20],
    'max_personas'      => [1, 50],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!token_valido()) {
        $errores[] = 'Sesión vencida. Intenta de nuevo.';
    } else {

        $nuevos = [];

        // ---------- PASO 1: revisar todo ----------
        foreach ($numericos as $clave => $rango) {
            $valor = $_POST[$clave] ?? '';
            if (!ctype_digit((string)$valor)) {
                $errores[] = "$clave debe ser un número entero.";
                continue;
            }
            $valor = (int)$valor;
            if ($valor < $rango[0] || $valor > $rango[1]) {
                $errores[] = "$clave debe estar entre {$rango[0]} y {$rango[1]}.";
                continue;
            }
            $nuevos[$clave] = (string)$valor;
        }

        // Revisión cruzada: el mínimo no puede ser mayor que el máximo.
        if (isset($nuevos['min_personas'], $nuevos['max_personas'])
            && (int)$nuevos['min_personas'] > (int)$nuevos['max_personas']) {
            $errores[] = 'El mínimo de personas no puede ser mayor que el máximo.';
        }

        // El WhatsApp: solo dígitos, con indicativo.
        $wa = preg_replace('/\D/', '', $_POST['whatsapp'] ?? '');
        if (strlen($wa) < 10 || strlen($wa) > 15) {
            $errores[] = 'El WhatsApp debe tener entre 10 y 15 dígitos (ej: 573001234567).';
        } else {
            $nuevos['whatsapp'] = $wa;
        }

        $negocio = trim($_POST['nombre_negocio'] ?? '');
        if ($negocio === '' || largo($negocio) > 60) {
            $errores[] = 'El nombre del negocio es obligatorio (máximo 60 letras).';
        } else {
            $nuevos['nombre_negocio'] = $negocio;
        }

        // ---------- PASO 2: guardar solo si no hay ni un error ----------
        if (empty($errores)) {
            $stmt = $db->prepare("UPDATE reservas_config SET valor = ? WHERE clave = ?");
            foreach ($nuevos as $clave => $valor) {
                $stmt->bind_param('ss', $valor, $clave);
                $stmt->execute();
            }
            guardar_mensaje('Configuración guardada. La página pública ya lo está usando.');
            header('Location: configuracion.php');
            exit;
        }
    }
}

$filas = $db->query("SELECT * FROM reservas_config ORDER BY clave")->fetch_all(MYSQLI_ASSOC);

panel_cabecera('Configuración', 'configuracion.php');
mensaje_guardado();

foreach ($errores as $e) {
    echo '<p class="pnl-msg pnl-malo">' . limpiar($e) . '</p>';
}
?>

<p class="pnl-ayuda">
    Nada de esto está escrito en el código: todo vive en la tabla
    <code>reservas_config</code>. Por eso el dueño puede ajustar su negocio
    sin llamar al programador.
</p>

<form method="POST">
    <input type="hidden" name="token" value="<?= token() ?>">

    <table class="pnl-tabla">
        <thead><tr><th>Qué es</th><th>Valor</th></tr></thead>
        <tbody>
        <?php foreach ($filas as $f): ?>
            <tr>
                <td>
                    <strong><?= limpiar(str_replace('_', ' ', $f['clave'])) ?></strong><br>
                    <small><?= limpiar($f['descripcion']) ?></small>
                </td>
                <td>
                    <?php if (isset($numericos[$f['clave']])): ?>
                        <input type="number" name="<?= limpiar($f['clave']) ?>"
                               value="<?= limpiar($f['valor']) ?>"
                               min="<?= $numericos[$f['clave']][0] ?>"
                               max="<?= $numericos[$f['clave']][1] ?>">
                    <?php else: ?>
                        <input type="text" name="<?= limpiar($f['clave']) ?>"
                               value="<?= limpiar($f['valor']) ?>" maxlength="60">
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <button type="submit" class="pnl-btn">Guardar configuración</button>
</form>

<?php panel_pie(); ?>
