<div class="order_card">
    <?php
    // REV Toda la lógica se puede optimizar mucho, porque hay llamadas que se repiten, sobre todo en la llamada indivisual a los elementos del pedido
    // OJO Incluso se puede optimizar desde DASHBOARD
    $fecha_pedido = formatMongoDate($order_data->dates->order);
    $fecha_pago_comprador = formatMongoDate($order_data->dates->payment_user);

    $send_dir = $mongo_db->exec(
        'find_one',
        'addresses',
        ['_id' => $order_data->shipping_address]
    );

    $total = 0;
    $products = [];
    foreach ($order_data->products as $prod) {
        $prod_info = $mongo_db->exec(
            'find_one',
            'products',
            ['_id' => $prod->_id]
        );
        $prod_price = $prod_info->stock[$prod->format]->price;
        // REV Esto se podría hacer con alguna funcion automatica al generar el documento desde el propio mongo (NO SE SI SE PUEDE HACER NI COMO) -> REVISAR
        array_push($products, $prod_info);
        $total += $prod_price * $prod->qty;
    }

    ?>
    <div class="order_info">
        <div class="item_order_info">
            <p>FECHA PEDIDO</p>
            <p><?php echo $fecha_pedido ?></p>
        </div>

        <div class="item_order_info">
            <p>FECHA PAGO</p>
            <p><?php echo $fecha_pago_comprador ?></p>
        </div>

        <div class="item_order_info">
            <p>TOTAL</p>
            <p><?php echo number_format($total, 2).'€' ?></p>
        </div>

        <div class="item_order_info">
            <p>ENVIADO A</p>
            <p><?php echo "{$send_dir->type}, {$send_dir->name}, {$send_dir->number}, {$send_dir->town}" ?></p>
        </div>

        <div class="item_order_info">
            <p><?php echo "Pedido n° $order_data->_id";?></p>
            <div class="cta_order_info">
                <a href="">Ver detalles del pedido</a>
                <a href="">Ver factura</a>
            </div>
        </div>
    </div>

    <div class="order_prods">
        <?php
        foreach ($products as $prod_idx => $product) {
            require(__DIR__.'/sales_card_item.php');
        }
        ?>
    </div>
</div>
