<div class="prod_checkout">
    <div class="prod_checkout_header">
        <span>
            Fecha de entrega estimada: <?php echo "" ?>
        </span>
        <span>
            Si realizas el pedido antes de XX horas XX minutos
        </span>
    </div>
    <div class="prod_checkout_info">
        <img class="prod_img_wrapper" src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod_info->imgs->cover ?>.jpg" alt="">
        <div class="cart_text_wrap">
            <span class='name'><?php echo $prod_info->name ?></span>
            <span class="producer">Vendido por: <?php echo $producerName ?></span>
            <br>
            <span class="stock"><?php echo $prod_info->stock[$prod_carrito->size]->qty > 0 ? 'En stock' : 'Agotado'; ?></span>
            <br>
            <span class="price"><?php echo $price ?>€</span>
            <div class="prod_qty_wrapper">
                <span>Cant.:&nbsp;</span>
                <span><?php echo $prod_carrito->qty ?></span>
                <img src="/DAW_proyecto_final/assets/icons/expand.svg" alt="">
            </div>
        </div>
        <div>
            <span>Elige un método de envío:</span>
            <div>
                <input type="radio" name="shipping_method1" id="">
                <label for="shipping_method1">
                    <span><strong>GRATIS</strong> A partir de 60€</span>
                    <span>--</span>
                    <span><?php echo "Establecer aqui fecha con PHP" ?></span>
                </label>
                <br>
                <input type="radio" name="shipping_method2" id="" selected>
                <label for="shipping_method2">
                    <span><strong>3,95€ Envío Express</strong></span>
                    <span>--</span>
                    <span><?php echo "Establecer aqui fecha con PHP" ?></span>
                </label>
            </div>
        </div>
    </div>
</div>