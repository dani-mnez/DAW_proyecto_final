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
                if ($prod_cat_qty) {
                    foreach ($prod_cat_qty as $row) {
                        echo "<option value='$row->name'>$row->name</option>";
                    }
                }
                ?>
            </select>
            <input type="search" name="" id="">
            <input type="submit" value="Busca">
        </div>

        <div id="user_control">
            <?php if (isset($user_data)) : ?>
                <a id="cart_icon" href="/DAW_proyecto_final/templates/cart.php">
                    <?php if (count($user_data->cart) > 0) :
                        $totalProdsInCart = 0;
                        foreach ($user_data->cart as $prod) {
                            foreach ($prod->sizes as $size => $val) {
                                $totalProdsInCart += $val->qty;
                            }
                        }
                    ?>
                        <div class="cart_prod_count">
                            <p><?php echo $totalProdsInCart; ?></p>
                        </div>
                    <?php endif; ?>
                </a>
                <div id="prof_wrap">
                    <?php
                    $prof_pic = ($user_data->profile_img) ? '/DAW_proyecto_final/assets/db_data/users/' . $user_data->_id . '.jpg' : '/DAW_proyecto_final/assets/img/default_profile_img.png';
                    ?>
                    <img class='profile_pic' src="<?php echo $prof_pic ?>" alt="Imagen de perfil">
                    <?php include_once(__DIR__ . './menu/profile_pic_menu.php'); ?>
                </div>
            <?php else : ?>
                <button onclick="show_log_reg()" id="access_btn" type="button">Accede</button>
            <?php endif; ?>
        </div>
    </div>
</nav>