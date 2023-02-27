<?php
$producer = unserialize($_SESSION['user'])->type == 'producer';
?>

<div id="dash_menu">
    <nav aria-label="Menú lateral">
        <ul>
            <li class="<?php if ($_GET['page'] == 'resume') echo "selected_dash_section"?>"><a href="/DAW_proyecto_final/templates/dashboard.php?page=resume">Resumen</a></li>
            <li class="<?php if ($_GET['page'] == 'profile') echo "selected_dash_section"?>"><a href="/DAW_proyecto_final/templates/dashboard.php?page=profile">Perfil</a></li>

            <?php if (!$producer): ?>
                <li class="<?php if ($_GET['page'] == 'lists') echo "selected_dash_section"?>"><a href="/DAW_proyecto_final/templates/dashboard.php?page=lists">Tus listas</a></li>
                <li class="<?php if ($_GET['page'] == 'orders') echo "selected_dash_section"?>"><a href="/DAW_proyecto_final/templates/dashboard.php?page=orders">Pedidos</a></li>
            <?php else: ?>
                <li class="<?php if ($_GET['page'] == 'products') echo "selected_dash_section"?>"><a href="/DAW_proyecto_final/templates/dashboard.php?page=products">Productos</a></li>
                <li class="<?php if ($_GET['page'] == 'sales') echo "selected_dash_section"?>"><a href="/DAW_proyecto_final/templates/dashboard.php?page=sales">Ventas</a></li>
            <?php endif; ?>

            <li class="<?php if ($_GET['page'] == 'messages') echo "selected_dash_section"?>"><a href="/DAW_proyecto_final/templates/dashboard.php?page=messages">
                Mensajes
                <span><?php echo 13; ?></span> //¿Por qué un 13?
            </a></li>

            <?php if ($producer): ?>
                <li class="<?php if ($_GET['page'] == 'incidences') echo "selected_dash_section"?>"><a href="/DAW_proyecto_final/templates/dashboard.php?page=incidences">Incidencias</a></li>
            <?php endif; ?>

            <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=feedback">Feedback</a></li>
            <li><a href="/DAW_proyecto_final/templates/dashboard.php?page=help">Ayuda</a></li>
        </ul>
    </nav>
</div>
