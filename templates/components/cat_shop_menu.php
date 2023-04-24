<nav id="cat_shop_menu" aria-label="Menú lateral">
    <p id="cat_shop_menu_title">Compra por: Categoría</p>
    <div id="cat_shop_menu_buttons">
        <a class="cat_shop_btn">Todos</a>
        <?php
        if ($prod_cat_qty) :
            foreach ($prod_cat_qty as $row) :
        ?>
                <a class="cat_shop_btn" href="/DAW_proyecto_final/templates/cat_shop.php?cat_id=<?php echo $row->_id; ?>" style="background-image: <?php echo "url('../assets/db_data/cats/$row->name.jpg')"; ?>;"><?php echo $row->name; ?></a>
        <?php
            endforeach;
        endif;
        ?>
    </div>
</nav>
<p><?php echo count($products->toArray()) ?> productos</p>