<div class="prod">
    <div class="container_data">
        <img class="img_prod" src="<?php echo "/DAW_proyecto_final/assets/db_data/products/{$products[$i]->imgs->cover}.jpg"; ?>" alt="Imagen de producto">
        <h3><?php echo $products[$i]->name; ?></h3>
        <div class="container_prod">
            <?php 
                foreach ($products[$i]->stock as $size): ?>
                    <div class="stock_info_block">
                    <p><?php echo "Formato: " . $size->format; ?></p>
                    <p><?php echo "Precio: " .  $size->price . " €"; ?></p>
                    <p><?php echo "Stock: " .  $size->qty . " ud"; ?></p>
                    <p><?php echo "Peso: " .  $size->weight . " gr"; ?></p>
                    </div>
                <?php 
                endforeach;
            ?> 
        </div>
    </div>
    <div class="container_btn">
        <button class="edit_prod_btn">Editar producto en su página</button>
        <button class="delete_prod_btn">Eliminar</button>
    </div>
</div>