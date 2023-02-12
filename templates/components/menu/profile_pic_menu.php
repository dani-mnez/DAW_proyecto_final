<nav id='profile_pic_menu' aria-label="Menú principal">
    <?php $producer = (isset($_COOKIES['user']) && $_COOKIES['user']->type == 'producer') ?>
    <ul>
        <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=resume">Resumen</a></li>
        <div class="menu_divider"></div>
        <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=profile">Perfil</a></li>

        <?php if (!$producer): ?>
            <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=lists">Tus listas</a></li>
            <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=orders">Pedidos</a></li>
            <?php else: ?>
                <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=products">Productos</a></li>
                <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=sales">Ventas</a></li>
                <?php endif; ?>

                <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=messages">Mensajes</a></li>

            <?php if ($producer):?><li><a href="/DAW_proyecto_final/templates/dashboard.php?page=incidences">Incidencias</a></li><?php endif?>

        <div class="menu_divider"></div>
        <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=feedback">Feedback</a></li>
        <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=help">Ayuda</a></li>
        <li><a href="/DAW_proyecto_final/modules/logout_logic.php">Salir</a></li>
    </ul>
</nav>
