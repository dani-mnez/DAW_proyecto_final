<div id="prod"> 
    <img src="<?php echo "/DAW_proyecto_final/assets/db_data/products/{$products[$i]->imgs->cover}.jpg"; ?>" alt="Imagen de producto">
    <h3><?php echo $products[$i]->name; ?></h3>
    <div>
        <?php 
            foreach ($products[$i]->stock as $size): ?>
                <div id="stock_info">
                <p><?php echo "Formato: " . $size->format; ?></p>
                <p><?php echo "Precio: " .  $size->price . " €"; ?></p>
                <p><?php echo "Stock: " .  $size->qty . " ud"; ?></p>
                <p><?php echo "Peso: " .  $size->weight . " gr"; ?></p>
                </div>
            <?php 
            endforeach;
        ?> 
    </div>
    <button>Editar producto en su página</button>
    <button>Eliminar</button>
</div>