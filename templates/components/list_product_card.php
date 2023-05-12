<div class="list_product" data-id="<?php echo $prod->_id ?>">
    <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $prod->imgs->cover ?>.jpg" alt="Imagen de producto">

    <p class='product_name'><?php echo $prod->name ?></p>
    <p class='producer_name'>Vendido por: <a href="/DAW_proyecto_final/templates/producer_shop.php?producer_id=<?php echo $prod->producer ?>"><?php echo $producer_name ?></a></p>
    <p class="price"><?php echo number_format($prod->stock[0]->price, 2) ?><span>€</span></p>
    <p class='remaining'>Quedan <?php echo $prod->stock[0]->qty;
                                // TODO Hacer cosa para que ponga unidad o unidades según el count
                                ?> unidades</p>
    <div class="list_item_cta">
        <button>Mover a la cesta</button>
        <a href="">Eliminar</a>
        <!-- <a href="">Ver productos similares</a> -->
    </div>
</div>