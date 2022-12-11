<div class="product" data-id="<?php echo $prod->_id ?>">
    <div class="product_img_wrapper">
        <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod->imgs->cover ?>.jpg" alt="Imagen de producto">
        <?php if (isset($_COOKIES['user'])): ?>
            <div class="buttons">
                <a onclick="like_product(<?php echo $prod->id ?>)" class="like_btn"><img src="/DAW_proyecto_final/assets/icons/fav.svg" alt=""></a>
                <a onclick="add_product_cart(<?php echo $prod->id ?>)" class="add_cart_btn"><img src="/DAW_proyecto_final/assets/icons/add_cart.svg" alt=""></a>
            </div>
        <?php endif; ?>
    </div>
    <p class='producer_name'><?php echo $producer_name ?></p>
    <p class='product_name'><?php echo $prod->name ?></p>
    <p class='description'><?php echo $prod->description->short ?></p>
    <p class="subcat"><?php echo $subcat ?></p>
    <p class="price"><?php echo number_format($prod->stock[0]->price, 2) ?><span>€</span></p>
</div>
