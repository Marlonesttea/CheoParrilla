

<?php
require '../includes/funciones.php';
auth();
$adminPage = true;
$adminDashboard = true;

require __DIR__ . '/../includes/config/database.php';
$db = conectarDB();

incluirTemplates('header');

// ======================
// CONSULTAS ESTADÍSTICAS
// ======================
$resultTotal = mysqli_query($db, "SELECT COUNT(*) AS total FROM platos");
$total = mysqli_fetch_assoc($resultTotal)['total'];

$resultActivos = mysqli_query($db, "SELECT COUNT(*) AS activos FROM platos WHERE activo=1");
$activos = mysqli_fetch_assoc($resultActivos)['activos'];

$resultInactivos = mysqli_query($db, "SELECT COUNT(*) AS inactivos FROM platos WHERE activo=0");
$inactivos = mysqli_fetch_assoc($resultInactivos)['inactivos'];
?>

<section class="dashboard-shell" aria-label="Panel administrativo">
    <aside class="dashboard-sidebar">
        <a class="dashboard-brand" href="<?= BASE_URL ?>admin/index.php" aria-label="Cheo Parrilla, panel administrativo">
            <span class="dashboard-brand-mark"><img src="<?= BASE_URL ?>img/logoc.png" alt="" aria-hidden="true"></span>
            <span><strong>Cheo</strong><small>ADMINISTRACIÓN</small></span>
        </a>

        <p class="dashboard-nav-label">MENÚ PRINCIPAL</p>
        <nav class="dashboard-nav" aria-label="Administración">
            <a class="dashboard-nav-link is-active" href="<?= BASE_URL ?>admin/index.php" aria-current="page">
                <i class="fa-solid fa-chart-pie" aria-hidden="true"></i><span>Resumen</span>
            </a>
            <a class="dashboard-nav-link" href="<?= BASE_URL ?>admin/menu/index.php">
                <i class="fa-solid fa-utensils" aria-hidden="true"></i><span>Platos</span>
            </a>
            <a class="dashboard-nav-link" href="<?= BASE_URL ?>admin/menu/crear.php">
                <i class="fa-solid fa-circle-plus" aria-hidden="true"></i><span>Crear plato</span>
            </a>
            <a class="dashboard-nav-link" href="<?= BASE_URL ?>admin/admiReserva/index.php">
                <i class="fa-regular fa-calendar-check" aria-hidden="true"></i><span>Reservas</span>
            </a>
        </nav>

        <a class="dashboard-exit" href="<?= BASE_URL ?>index.php">
            <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i><span>Volver al sitio</span>
        </a>
    </aside>

    <main class="dashboard-main">
        <header class="dashboard-heading">
            <div>
                <p class="dashboard-eyebrow">CHEO PARRILLA / ADMINISTRACIÓN</p>
                <h1>Resumen general</h1>
                <p class="dashboard-description">Estado actual de tu carta.</p>
            </div>
        </header>

        <section class="dashboard-section" aria-labelledby="dish-stats-title">
            <div class="dashboard-section-heading">
                <h2 id="dish-stats-title">Platos</h2>
                <a href="<?= BASE_URL ?>admin/menu/index.php">Ver listado <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
            </div>
            <div class="adm-stats">
                <article class="stat-card stat-total">
                    <span class="stat-icon"><i class="fa-solid fa-bowl-food" aria-hidden="true"></i></span>
                    <p>Total de platos</p>
                    <h3><?= $total ?></h3>
                    <small>En la carta</small>
                </article>
                <article class="stat-card stat-activos">
                    <span class="stat-icon"><i class="fa-solid fa-circle-check" aria-hidden="true"></i></span>
                    <p>Disponibles</p>
                    <h3><?= $activos ?></h3>
                    <small>Visibles para clientes</small>
                </article>
                <article class="stat-card stat-inactivos">
                    <span class="stat-icon"><i class="fa-solid fa-eye-slash" aria-hidden="true"></i></span>
                    <p>Inactivos</p>
                    <h3><?= $inactivos ?></h3>
                    <small>Ocultos de la carta</small>
                </article>
            </div>
        </section>

        <section class="dashboard-section dashboard-quick-actions" aria-labelledby="quick-actions-title">
            <div class="dashboard-section-heading">
                <h2 id="quick-actions-title">Accesos rápidos</h2>
            </div>
            <div class="dashboard-action-list">
                <a class="dashboard-action" href="<?= BASE_URL ?>admin/menu/crear.php">
                    <span class="dashboard-action-icon action-coral"><i class="fa-solid fa-plus" aria-hidden="true"></i></span>
                    <span><strong>Agregar un plato</strong><small>Incorpora una nueva opción a la carta</small></span>
                    <i class="fa-solid fa-arrow-right action-arrow" aria-hidden="true"></i>
                </a>
                <a class="dashboard-action" href="<?= BASE_URL ?>admin/admiReserva/index.php">
                    <span class="dashboard-action-icon action-teal"><i class="fa-regular fa-calendar" aria-hidden="true"></i></span>
                    <span><strong>Administrar reservas</strong><small>Consulta horarios y solicitudes</small></span>
                    <i class="fa-solid fa-arrow-right action-arrow" aria-hidden="true"></i>
                </a>
            </div>
        </section>
    </main>
</section>

<?php include '../includes/templates/footer.php'; ?>
