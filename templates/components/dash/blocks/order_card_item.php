<div class="order_item">
    <?php
    $producer = $mongo_db->exec(
        'find_one',
        'producers',
        ['_id' => $product->producer]
    );
    ?>
    <img class="prod_img" src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $product->imgs->cover  ?>.jpg"
     alt="">
    <div class="prod_text">
        <p><?php echo $product->name ?></p>
        <p>Vendido por: <?php echo $producer->company_name ?></p>
        <p>Se recibió el: <?php echo formatMongoDate($order_data->products[$prod_idx]->received_date) ?></p>
        <p><?php
        // Si el periodo de devolución ha terminado
        // Si no ha terminado
        $temp = (time()*1000 <= (int) (string) $order_data->products[$prod_idx]->devol_date) ? "terminará" : "terminó";

        echo "El periodo de devolución ".$temp." el ".formatMongoDate($order_data->products[$prod_idx]->devol_date)
        ?></p>
        <div class="cta_prod">
            <button>Volver a comprar</button>
            <button>Ver el producto</button>
            <button>Informar sobre un problema</button>
        </div>
    </div>
    <div class="prod_rate_cta">
        <p>Valora el producto:</p>
        <img src="/DAW_proyecto_final/assets/img/rate_imgs/0.svg" alt="Widget de valoración de producto">
        <button>Escribe una opinión</button>
    </div>
</div>
