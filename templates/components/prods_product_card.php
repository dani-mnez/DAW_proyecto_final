<div class="product" data-id="<?php echo $prod->_id ?>">
    <div class="product_img_wrapper">
        <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod->imgs->cover ?>.jpg" alt="Imagen de producto">
        <div class="buttons">
            <div class="like_btn <?php if (isFaved($prod->_id)) echo "faved" ?>"><img src="<?php echo (isFaved($prod->_id)) ? "/DAW_proyecto_final/assets/icons/fav_full.svg" : "/DAW_proyecto_final/assets/icons/fav.svg" ?>" alt=""></div>
            <div class="add_cart_btn"><img src="/DAW_proyecto_final/assets/icons/add_cart.svg" alt=""></div>
        </div>
    </div>
    <p class='product_name'><?php echo $prod->name ?></p>
    <p class='description'><?php echo $prod->description->short ?></p>
    <p class="price"><?php echo number_format($prod->stock[0]->price, 2) ?><span>€</span></p>
</div>