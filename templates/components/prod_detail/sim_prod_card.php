<div data-id="<?php echo $s_prod->_id ?>" class="sim_prod">
    <img src="<?php echo '/DAW_proyecto_final/assets/db_data/products/' . $s_prod->imgs->cover ?>.jpg" alt="Imagen de <?php $s_prod->name ?>">
    <div class="sim_prod_info">
        <p><?php echo $s_prod->name . ' (' . $s_prod->stock[0]->format . ')' ?></p>
        <p><?php echo $s_prod->stock[0]->price ?>€</p>
    </div>
    <button>Añadir a la cesta</button>
</div>