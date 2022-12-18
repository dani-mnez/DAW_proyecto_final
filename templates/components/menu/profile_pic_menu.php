<nav id='profile_pic_menu' aria-label="Menú principal">
    <?php $producer = (isset($_COOKIES['user']) && $_COOKIES['user']->type == 'producer') ?>
    <ul>
        <li><a href="/DAW_proyecto_final/templates/dashboard.php">Resumen</a></li>
        <li><a href="">Perfil</a></li>

        <?php if (!$producer): ?>
            <li><a href="">Tus listas</a></li>
            <li><a href="">Pedidos</a></li>
        <?php else: ?>
            <li><a href="">Productos</a></li>
            <li><a href="">Ventas</a></li>
        <?php endif; ?>

        <li><a href="">Mensajes</a></li>

        <?php if ($producer):?><li><a href="">Incidencias</a></li><?php endif?>

        <li><a href="">Feedback</a></li>
        <li><a href="">Ayuda</a></li>
        <li><a href="/DAW_proyecto_final/modules/logout_logic.php">Salir</a></li>
    </ul>
</nav>
