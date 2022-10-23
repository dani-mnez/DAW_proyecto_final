<nav id="main_menu" aria-label="Menú principal">
    <img src="assets/img/logo_2.svg" alt="Logo">
    <ul>
        <li><a href="">Tienda</a></li>
        <li><a href="">Nosotros</a></li>
        <li><a href="">Los productores</a></li>
    </ul>

    <div id="user_control">
        <?php if(isset($_SESSION['user'])): ?>
            <a href="./templates/dashboard.php">
                <img id="carrito" src="./assets/icons/cart.svg" alt="Carrito">
            </a>
            <img class='profile_pic' src="<?php echo $_SESSION['user']['img_path'] ?? './assets/img/default_profile_img.png' ?>" alt="Imagen de perfil">
        <?php else: ?>
            <a onclick="show_log_reg()">Accede</a>
        <?php endif; ?>
    </div>
</nav>
