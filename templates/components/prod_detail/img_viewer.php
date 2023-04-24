<div id="imgs_viewer">
    <div id="main_viewer">
        <div id="img_viewer_nav">
            <div class="img_nav_btn" id="img_viewer_nav_left">
                <img src="/DAW_proyecto_final/assets/icons/arrow_back.svg" alt="">
            </div>
            <div class="img_nav_btn" id="img_viewer_nav_right">
                <img src="/DAW_proyecto_final/assets/icons/arrow_fwd.svg" alt="">
            </div>
        </div>
        <img id="main_image" src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod->imgs->cover ?>.jpg" alt="Imagen del producto">
    </div>

    <div class="thumbnail_wrapper">
        <img class="thumbnail selected_thumbnail" src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod->imgs->cover ?>.jpg" alt="Imagen del producto">
        <?php if (count($prod->imgs->detail) > 0) : ?>
            <?php foreach ($prod->imgs->detail as $img) : ?>
                <img class="thumbnail" src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $img . '.jpg' ?>" alt="Imagen del producto">
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>