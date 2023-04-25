<div class="prod_checkout">
    <div class="prod_checkout_header">
        <span>Fecha de entrega estimada: <?php
                                            $fecha = new DateTime('now');
                                            $fecha->modify('+2 day');
                                            echo $fecha->format('j M');
                                            ?></span>
        <span><?php
                date_default_timezone_set('Europe/Madrid');

                $time_now = time();
                $end_of_day = strtotime('today 23:59:59');
                $time_left = $end_of_day - $time_now;

                // Convertir la diferencia de tiempo en horas y minutos
                $hours_left = gmdate('H', $time_left);
                $minutes_left = gmdate('i', $time_left);

                echo "Si realizas el pedido antes de $hours_left horas $minutes_left minutos";
                ?>
        </span>
    </div>
    <div class="prod_checkout_info">
        <img class="prod_img_wrapper" src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod_info->imgs->cover ?>.jpg" alt="">
        <div class="cart_text_wrap">
            <span class='name'><?php echo $prod_info->name ?></span>
            <span class="producer">Vendido por: <?php echo $producerName ?></span>
            <span class="stock"><?php echo $prod_info->stock[$prod_carrito->size]->qty > 0 ? 'En stock' : 'Agotado'; ?></span>
            <span class="price"><?php echo $price ?>€</span>
            <div class="prod_qty_wrapper">
                <span>Cant.:&nbsp;</span>
                <span><?php echo $prod_carrito->qty ?></span>
                <img src="/DAW_proyecto_final/assets/icons/expand.svg" alt="">
            </div>
        </div>
        <div class="shipping">
            <span>Elige un método de envío:</span>
            <div>
                <label for="shipping_method1">
                    <input type="radio" name="shipping_method" id="shipping_method1" value="free">
                    <span><strong>GRATIS</strong> A partir de 60€ -- <?php $texto = "recíbelo el " . date("l, d \\d\\e F");
                                                                        echo $texto; ?></span>
                </label>
                <label for="shipping_method2">
                    <input type="radio" name="shipping_method" id="shipping_method2" value="express" checked>
                    <span><strong>3,95€ Envío Express</strong> -- <?php $texto = "recíbelo el " . date("l, d \\d\\e F", strtotime("+2 days"));
                                                                    echo $texto; ?></span>
                </label>
            </div>
        </div>
    </div>
</div>