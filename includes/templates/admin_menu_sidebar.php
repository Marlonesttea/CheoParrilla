<aside class="dashboard-sidebar">
    <a class="dashboard-brand" href="<?= BASE_URL ?>admin/index.php" aria-label="Cheo Parrilla, panel administrativo">
        <span class="dashboard-brand-mark"><img src="<?= BASE_URL ?>img/logoc.png" alt="" aria-hidden="true"></span>
        <span><strong>Cheo</strong><small>ADMINISTRACIÓN</small></span>
    </a>

    <p class="dashboard-nav-label">MENÚ PRINCIPAL</p>
    <nav class="dashboard-nav" aria-label="Administración">
        <a class="dashboard-nav-link" href="<?= BASE_URL ?>admin/index.php">
            <i class="fa-solid fa-chart-pie" aria-hidden="true"></i><span>Resumen</span>
        </a>
        <a class="dashboard-nav-link <?= in_array($adminMenuActive, ['list', 'edit'], true) ? 'is-active' : '' ?>" href="<?= BASE_URL ?>admin/menu/index.php" <?= in_array($adminMenuActive, ['list', 'edit'], true) ? 'aria-current="page"' : '' ?>>
            <i class="fa-solid fa-utensils" aria-hidden="true"></i><span>Platos</span>
        </a>
        <a class="dashboard-nav-link <?= $adminMenuActive === 'create' ? 'is-active' : '' ?>" href="<?= BASE_URL ?>admin/menu/crear.php" <?= $adminMenuActive === 'create' ? 'aria-current="page"' : '' ?>>
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