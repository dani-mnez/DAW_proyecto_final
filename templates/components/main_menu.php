<nav id="main_menu" aria-label="Menú principal">
    <div id="m_menu_content">
        <a href="/DAW_proyecto_final/index.php" id="logo_menu">
            <img src="/DAW_proyecto_final/assets/img/logo.png" alt="Logo">
        </a>
        <ul>
            <li><a href="/DAW_proyecto_final/templates/shop.php">Tienda</a></li>
            <li><a href="/DAW_proyecto_final/templates/nosotros.php">Nosotros</a></li>
            <li><a href="">Los productores</a></li>
        </ul>

        <div id="main_search">
            <select>
                <?php
                $results = $mongo_db->exec(
                    'distinct',
                    'products',
                    'category'
                );

                if ($results) {
                    foreach ($results as $idx => $row) {
                        echo "<option value='$row'>$row</option>";
                    }
                }
                ?>
            </select>
            <input type="search" name="" id="">
            <input type="submit" value="Busca">
        </div>

        <div id="user_control">
            <?php if(isset($_SESSION['user'])): ?>
                <a href="/DAW_proyecto_final/templates/cart.php">
                    <img id="carrito" src="/DAW_proyecto_final/assets/icons/cart.svg" alt="Carrito">
                </a>
                <div id="prof_wrap">
                    <?php
                    if (unserialize($_SESSION['user'])->prof_img) {
                        $prof_pic = '/DAW_proyecto_final/assets/db_data/users/'.unserialize($_SESSION['user'])->id.'.jpg';
                    } else {
                        $prof_pic = '/DAW_proyecto_final/assets/img/default_profile_img.png';
                    }
                    ?>
                    <img class='profile_pic' src="<?php echo $prof_pic ?>" alt="Imagen de perfil">
                    <?php include_once(__DIR__ . './menu/profile_pic_menu.php'); ?>
                </div>
            <?php else: ?>
                <button onclick="show_log_reg()" id="access_btn" type="button">Accede</button>
            <?php endif; ?>
        </div>
    </div>
</nav>
