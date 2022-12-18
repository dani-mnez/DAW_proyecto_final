<?php
$producer = unserialize($_SESSION['user'])->type == 'producer';
?>

<div id="dash_menu">
    <nav aria-label="Menú lateral">
        <ul>
            <li><a href="">Resumen</a></li>
            <li><a href="">Perfil</a></li>

            <?php if (!$producer): ?>
                <li><a href="">Tus listas</a></li>
                <li><a href="">Pedidos</a></li>
            <?php else: ?>
                <li><a href="">Productos</a></li>
                <li><a href="">Ventas</a></li>
            <?php endif; ?>

            <li><a href="">
                Mensajes
                <span><?php echo 13; ?></span>
            </a></li>

            <?php if ($producer): ?>
                <li><a href="">Incidencias</a></li>
            <?php endif; ?>

            <li><a href="">Feedback</a></li>
            <li><a href="">Ayuda</a></li>
        </ul>
    </nav>
</div>
