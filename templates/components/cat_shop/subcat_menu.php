<nav id="subcat_shop_menu" aria-label="Menú lateral">
    <p id="subcat_shop_menu_title">Filtra por: Tipo</p>
    <div id="subcat_shop_menu_buttons">
        <?php
        if ($prod_cat_qty) :
            foreach ($subcats as $subcat) :
        ?>
                <div class="subcat_button" data-subcat="<?php echo $subcat->name ?>">
                    <div class="subcat_img">
                        <img src="/DAW_proyecto_final/assets/img/share_wa.webp" alt="Icono de categoría de producto">
                    </div>
                    <p class="subcat_name"><?php echo $subcat->name; ?></p>
                </div>
        <?php
            endforeach;
        endif;
        ?>
    </div>
</nav>