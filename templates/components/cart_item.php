<div class="cart_item" data-prod-id="<?php echo $prod_info->_id ?>" data-prod-size="<?php echo $prod_size_buyed ?>">
    <div class="prod_img_wrapper">
        <input type="checkbox" name="prod_checked" class="prod_checkbox" <?php echo ($sizeInfo->selected) ? 'checked' : ''; ?>>
        <a href="/DAW_proyecto_final/templates/product_detail.php?id=<?php echo $prod_info->_id ?>">
            <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod_info->imgs->cover ?>.jpg" alt="">
        </a>

    </div>
    <div class="cart_text_wrap">
        <span class='name'><?php echo "{$prod_info->name} ({$prod_info->stock[$prod_size_buyed]->format})" ?></span>
        <span class="producer">Vendido por: <a href="/DAW_proyecto_final/templates/producer_shop.php?producer_id=<?php echo $prod_info->producer ?>"><?php echo $producerName ?></a></span>

        <span class="stock"><?php echo $prod_info->stock[$prod_size_buyed]->qty > 0 ? 'En stock' : 'Agotado'; ?></span>

        <div class="prod_management">
            <?php if ($prod_qty_buyed >= 10) : ?>
                <div class="textbox_qty_wrapper">
                    <input type="text" name="prod_qty" value="<?php echo $prod_qty_buyed; ?>">
                    <button class="qty_checkbox_btn">Actualizar</button>
                </div>
            <?php else : ?>
                <div class="prod_qty_wrapper">
                    <span>Cant.:&nbsp;</span>
                    <span class="prod_qty_number"><?php echo $prod_qty_buyed ?></span>
                    <img src="/DAW_proyecto_final/assets/icons/expand.svg" alt="">
                </div>
            <?php endif; ?>
            <span class="cart_card_cta_btn" data-action="delete">Eliminar</span>
            <span class="cart_card_cta_btn" data-action="later">Guardar para más tarde</span>
            <!-- <span class="cart_card_cta_btn">Ver otros productos como este</span> -->
        </div>
    </div>
    <span class="price"><?php echo $price ?>€</span>
</div>