<div class="cart_item" data-prod-id="<?php echo $prod_info->_id ?>">
    <div class="prod_img_wrapper">
        <input type="checkbox" name="prod_checked" class="prod_checkbox" <?php echo ($prod->selected) ? 'checked' : ''; ?>>
        <a href="/DAW_proyecto_final/templates/product_detail.php?id=<?php echo $prod_info->_id ?>">
            <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod_info->imgs->cover ?>.jpg" alt="">
        </a>

    </div>
    <div class="cart_text_wrap">
        <span class='name'><?php echo $prod_info->name ?></span>
        <span class="producer">Vendido por: <a href="/DAW_proyecto_final/templates/producer_shop.php?producer_id=<?php echo $prod_info->producer ?>"><?php echo $producerName ?></a></span>

        <span class="stock"><?php echo $prod_info->stock[$prod_size_buyed]->qty > 0 ? 'En stock' : 'Agotado'; ?></span>

        <div class="prod_management">
            <div class="prod_qty_wrapper">
                <span>Cant.:&nbsp;</span>
                <span><?php echo $prod_qty_buyed ?></span>
                <img src="/DAW_proyecto_final/assets/icons/expand.svg" alt="">
            </div>
            <span class="cart_card_cta_btn">Eliminar</span>
            <span class="cart_card_cta_btn">Guardar para más tarde</span>
            <!-- <span class="cart_card_cta_btn">Ver otros productos como este</span> -->
        </div>
    </div>
    <span class="price"><?php echo $price ?>€</span>
</div>