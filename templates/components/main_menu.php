<nav id="main_menu" aria-label="Menú principal">
    <div id="m_menu_content">
        <a href="/DAW_proyecto_final/index.php" id="logo_menu">
            <img src="/DAW_proyecto_final/assets/img/logo.png" alt="Logo">
        </a>
        <ul>
            <li><a href="/DAW_proyecto_final/templates/shop.php">Tienda</a></li>
            <li><a href="/DAW_proyecto_final/templates/nosotros.php">Nosotros</a></li>
            <li><a href="/DAW_proyecto_final/templates/producers.php">Los productores</a></li>
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

        <?php if (isset($_SESSION['user'])) : ?>
            <div id="user_control">
                <?php if (isset($user_data)) : ?>
                    <?php if ($user_data->type == 'producer') : ?>
                        <div id="prof_wrap">
                            <?php
                            $prof_pic = (isset($user_data->profile_img)) ? '/DAW_proyecto_final/assets/db_data/users/' . $user_data->_id . '.jpg' : '/DAW_proyecto_final/assets/img/default_profile_img.png';
                            ?>
                            <img class='profile_pic' src="<?php echo $prof_pic ?>" alt="Imagen de perfil">
                            <?php include_once(__DIR__ . './menu/profile_pic_menu.php'); ?>
                        </div>
                    <?php elseif ($user_data->type == "buyer") : ?>
                        <a id="cart_icon" href="/DAW_proyecto_final/templates/cart.php">
                            <?php if (count($user_data->cart) > 0) : ?>
                                <div class="cart_prod_count">
                                    <p><?php echo count($user_data->cart); ?></p>
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
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <button onclick="show_log_reg()" id="access_btn" type="button">Accede</button>
        <?php endif; ?>
    </div>
</nav>