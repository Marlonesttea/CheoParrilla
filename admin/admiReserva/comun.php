<?php
/* ============================================================
   COMUN.PHP  -  Lo que comparten las pantallas del panel.
   ------------------------------------------------------------
   Reutiliza la sesion que ya crea admin/login.php del proyecto
   ($_SESSION['login']), asi no hay dos logins distintos.
   ============================================================ */

require_once __DIR__ . '/../../includes/config/agenda_reservas.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/** Si no hay sesion, no se ve nada del panel. */
function exigir_sesion(): void
{
    if (empty($_SESSION['login'])) {
        header('Location: ../login.php');
        exit;
    }
}

/* ------------------------------------------------------------
   TOKEN CSRF
   Evita que una pagina ajena haga cambios en el panel usando la
   sesion abierta del administrador. Cada formulario del panel
   lleva este token escondido y el servidor lo revisa.
   ------------------------------------------------------------ */
function token(): string
{
    if (empty($_SESSION['token_reservas'])) {
        $_SESSION['token_reservas'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['token_reservas'];
}

function token_valido(): bool
{
    return isset($_POST['token'], $_SESSION['token_reservas'])
        && hash_equals($_SESSION['token_reservas'], $_POST['token']);
}


function panel_cabecera(string $titulo, string $activo = ''): void
{
    $menu = [
        'index.php'         => 'Reservas',
        'horarios.php'      => 'Horario semanal',
        'bloqueos.php'      => 'Días bloqueados',
        'configuracion.php' => 'Configuración',
    ];
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= limpiar($titulo) ?> | Panel de reservas</title>
        <link rel="stylesheet" href="../../reservas/css/reservas.css">
        <link rel="stylesheet" href="../../reservas/css/panel.css">
    </head>
    <body>
    <header class="rsv-header">
        <span class="rsv-marca">Panel de reservas</span>
        <a class="rsv-volver" href="../index.php">&lsaquo; Panel principal</a>
    </header>

    <nav class="pnl-menu">
        <?php foreach ($menu as $archivo => $texto): ?>
            <a href="<?= $archivo ?>" class="<?= $activo === $archivo ? 'pnl-activo' : '' ?>">
                <?= $texto ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <main class="pnl-main">
        <h1><?= limpiar($titulo) ?></h1>
    <?php
}

function panel_pie(): void
{
    echo '</main></body></html>';
}

/** Muestra el mensaje verde o rojo que quedó guardado tras un cambio. */
function mensaje_guardado(): void
{
    if (!empty($_SESSION['msg'])) {
        $clase = ($_SESSION['msg_tipo'] ?? 'bien') === 'malo' ? 'pnl-malo' : 'pnl-bien';
        echo '<p class="pnl-msg ' . $clase . '">' . limpiar($_SESSION['msg']) . '</p>';
        unset($_SESSION['msg'], $_SESSION['msg_tipo']);
    }
}

function guardar_mensaje(string $texto, string $tipo = 'bien'): void
{
    $_SESSION['msg'] = $texto;
    $_SESSION['msg_tipo'] = $tipo;
}
