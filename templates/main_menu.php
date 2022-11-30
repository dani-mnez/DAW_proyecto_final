<nav id="main_menu" aria-label="Menú principal">
    <div id="m_menu_content">
        <a href="/DAW_proyecto_final/index.php" id="logo_menu">
            <img src="/DAW_proyecto_final/assets/img/logo.png" alt="Logo">
        </a>
        <ul>
            <li><a href="/DAW_proyecto_final/templates/shop.php">Tienda</a></li>
            <li><a href="">Nosotros</a></li>
            <li><a href="">Los productores</a></li>
        </ul>

        <div id="user_control">
            <?php if(isset($_SESSION['user'])): ?>
                <a href="/DAW_proyecto_final/templates/cart.php">
                    <img id="carrito" src="/DAW_proyecto_final/assets/icons/cart.svg" alt="Carrito">
                </a>
                <div id="prof_wrap">
                    <img class='profile_pic' src="<?php echo $_SESSION['user']['img_path'] ?? '/DAW_proyecto_final/assets/img/default_profile_img.png' ?>" alt="Imagen de perfil">
                    <?php include_once(__DIR__ . '/../templates/profile_pic_menu.php'); ?>
                </div>
            <?php else: ?>
                <a id="access_btn">Accede</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
